<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\CashDonation;
use App\Services\PayMongoService;
use Illuminate\Support\Str;
use App\Helpers\SmsHelper;
use App\Models\Chapter;

class PayMongoController extends Controller
{
    public function createCheckout(Request $request)
    {
        $user = Auth::user();
        $donor = $user->donor;

        $donorName = ($request->has('anonymous_checkbox') && $request->anonymous_checkbox == 1)
            ? 'Anonymous'
            : "{$donor->first_name} {$donor->last_name}";

        session([
            'donation_data' => [
                'donor_id' => $donor->id,
                'donor_name' => $donorName,
                'contact' => $donor->contact,
                'chapter_id' => $request->chapter_id,
                'fund_request_id' => $request->fund_request_id,
                'cause' => $request->cause,
                'amount' => $request->amount,
                'donation_method' => 'online',
                'payment_method' => $request->payment_method,
            ]
        ]);

        // PayMongo API request
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode(env('PAYMONGO_SECRET_KEY')),
            'Content-Type' => 'application/json'
        ])->post('https://api.paymongo.com/v1/checkout_sessions', [
            'data' => [
                'attributes' => [
                    'billing' => [
                        'email' => $user->email,
                        'phone' => ltrim($donor->contact, '0'),
                        'name' => $donorName,
                    ],
                    'send_email_receipt' => true,
                    'description' => "Donation for {$request->cause}",
                    'line_items' => [
                        [
                            'currency' => 'PHP',
                            'amount' => (int) ($request->amount * 100),
                            'name' => "Donation for {$request->cause} at {$request->request_location}",
                            'quantity' => 1
                        ]
                    ],
                    'payment_method_types' => ['gcash', 'card', 'paymaya'],
                    'success_url' => route('paymongoMap.success'),
                    'cancel_url' => route('paymongoMap.cancel')
                ]
            ]
        ]);

        if ($response->successful()) {
            $checkoutData = $response->json();
            return redirect()->away($checkoutData['data']['attributes']['checkout_url']);
        } else {
            return back()->with('error', 'Failed to initiate PayMongo checkout.');
        }
    }

    public function handleSuccess(Request $request)
    {
        try {
            $donationData = session('donation_data');

            if (!$donationData) {
                return redirect()->route('donor.reqCash_map')->with('error', 'No pending donation found.');
            }

            $transactionId = 'Pay-' . now()->format('Ymd-His') . '-' . strtoupper(Str::random(6));

            $donation = CashDonation::create([
                'donor_id' => $donationData['donor_id'],
                'donor_name' => $donationData['donor_name'],
                'chapter_id' => $donationData['chapter_id'],
                'fund_request_id' => $donationData['fund_request_id'],
                'cause' => $donationData['cause'],
                'amount' => $donationData['amount'],
                'donation_method' => 'online',
                'payment_method' => $donationData['payment_method'],
                'payment_status' => 'completed',
                'status' => 'received',
                'transaction_id' => $transactionId,
            ]);

            session()->forget('donation_data');

            // Fetch donor contact number
            $donorContact = $donationData['contact'] ?? null;

            if ($donorContact) {
                $message = "Hello {$donation->donor_name}, your cash donation of ₱ " . number_format($donation->amount, 2) .
                    " via {$donation->payment_method} was received. Check your email for the receipt. Thank you!";
                SmsHelper::sendSmsNotification($donorContact, $message);
            }

            return redirect()->route('donor.reqCash_map')->with('success', 'Donation successful! Thank you.');
        } catch (\Exception $e) {
            return redirect()->route('donor.reqCash_map')->with('error', 'Something went wrong. Please try again.');
        }
    }


    public function handleCancel(Request $request)
    {
        // Clear session if payment is canceled
        session()->forget('donation_data');

        return redirect()->route('donor.reqCash_map')->with('error', 'Payment was canceled.');
    }

    // Handle Quick Cash Donation via PayMongo
    public function quickPayMongo(Request $request)
    {
        $user = Auth::user();
        $donor = $user->donor;

        if (!$donor) {
            return back()->with('error', 'Donor profile not found.');
        }

        // Determine donor name (Anonymous or Not)
        $donorName = ($request->has('anonymous_checkbox') && $request->anonymous_checkbox == 1)
            ? 'Anonymous'
            : "{$donor->first_name} {$donor->last_name}";

        // Store quick donation details in session before processing payment
        session([
            'quick_donation_data' => [
                'donor_id' => $donor->id,
                'donor_name' => $donorName,
                'chapter_id' => $request->chapter_id,
                'cause' => $request->cause,
                'amount' => $request->amount,
                'donation_method' => 'online',
                'payment_method' => $request->payment_method,
                'contact' => $donor->contact
            ]
        ]);

        // PayMongo API Request
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode(env('PAYMONGO_SECRET_KEY')),
            'Content-Type' => 'application/json'
        ])->post('https://api.paymongo.com/v1/checkout_sessions', [
            'data' => [
                'attributes' => [
                    'billing' => [
                        'email' => $user->email,
                        'phone' => ltrim($donor->contact, '0'),
                        'name' => $donorName,
                    ],
                    'send_email_receipt' => true,
                    'description' => "Quick Donation for {$request->cause}",
                    'line_items' => [
                        [
                            'currency' => 'PHP',
                            'amount' => (int) ($request->amount * 100),
                            'name' => "Quick Donation for {$request->cause}",
                            'quantity' => 1
                        ]
                    ],
                    'payment_method_types' => ['gcash', 'card', 'paymaya'],
                    'success_url' => route('quickCash.success'),
                    'cancel_url' => route('quickCash.cancel')
                ]
            ]
        ]);

        if ($response->successful()) {
            $checkoutData = $response->json();
            return redirect()->away($checkoutData['data']['attributes']['checkout_url']);
        } else {
            return back()->with('error', 'Failed to initiate PayMongo checkout.');
        }
    }

    public function quickPayMongoSuccess(Request $request)
    {
        try {
            $donationData = session('quick_donation_data');

            if (!$donationData) {
                return redirect()->route('quick.cashForm')->with('error', 'No pending donation found.');
            }

            $transactionId = 'Pay-' . now()->format('Ymd-His') . '-' . strtoupper(Str::random(6));

            // Insert data into the database after successful payment
            $donation = CashDonation::create([
                'donor_id' => $donationData['donor_id'],
                'donor_name' => $donationData['donor_name'],
                'chapter_id' => $donationData['chapter_id'],
                'cause' => $donationData['cause'],
                'amount' => $donationData['amount'],
                'donation_method' => 'online',
                'payment_method' => $donationData['payment_method'],
                'payment_status' => 'completed',
                'status' => 'received',
                'transaction_id' => $transactionId,
            ]);

            // Fetch chapter name
            $chapter = Chapter::find($donationData['chapter_id']);
            $chapterName = $chapter ? $chapter->chapter_name : 'Unknown Chapter';

            // Fetch donor contact number
            $donorContact = $donationData['contact'] ?? null;

            // Send SMS notification
            if ($donorContact) {
                $message = "Hello {$donation->donor_name}, your online donation of PHP {$donation->amount} for {$donation->cause} at {$chapterName} was successful. Thank you for your generosity!";
                SmsHelper::sendSmsNotification($donorContact, $message);
            }

            // Clear session
            session()->forget('quick_donation_data');

            return redirect()->route('quick.cashForm')->with('success', 'Quick donation successful! Thank you for your support.');
        } catch (\Exception $e) {
            return redirect()->route('quick.cashForm')->with('error', 'Something went wrong. Please try again.');
        }
    }


    public function quickPayMongoCancel(Request $request)
    {
        // Clear session if payment is canceled
        session()->forget('quick_donation_data');

        return redirect()->route('quick.cashForm')->with('error', 'Payment was canceled.');
    }
}
