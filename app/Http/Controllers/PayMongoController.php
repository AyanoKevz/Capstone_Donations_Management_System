<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Models\CashDonation;
use App\Services\PayMongoService;
use Illuminate\Support\Str;
use App\Helpers\SmsHelper;
use App\Models\Chapter;
use App\Models\UserAccount;
use Exception;
use App\Models\PooledFund;
use Illuminate\Support\Facades\DB;

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
        // Validate session data
        $donationData = session('donation_data');
        if (!$donationData) {
            return redirect()->route('donor.reqCash_map')->with('error', 'No pending donation found.');
        }

        // Create donation record
        $donation = CashDonation::create([
            'donor_id' => $donationData['donor_id'],
            'donor_name' => $donationData['donor_name'],
            'chapter_id' => $donationData['chapter_id'],
            'fund_request_id' => $donationData['fund_request_id'] ?? null,
            'cause' => $donationData['cause'],
            'amount' => $donationData['amount'],
            'donation_method' => 'online',
            'payment_method' => $donationData['payment_method'],
            'payment_status' => 'completed',
            'status' => 'received',
            'transaction_id' => 'Pay-' . now()->format('Ymd-His') . '-' . strtoupper(Str::random(6)),
        ]);

        // Load chapter relationship
        $donation->load('chapter');
        $chapterName = $donation->chapter->chapter_name;

        // Get donor info
        $userAccount = UserAccount::find($donationData['donor_id']);
        $donorEmail = $userAccount->email;
        $donorContact = $donationData['contact'];

        // Prepare email content
        $emailData = [
            'logoPath' => public_path('assets/img/systemLogo.png'),
            'chapter' => $chapterName,
            'donation' => $donation,
            'type' => 'cash',
            'emailMessage' => "Thank you for your donation of ₱" . number_format($donation->amount, 2) .
                " to support {$donation->cause} at {$chapterName}. " .
                "Your donation via {$donation->payment_method} has been successfully received.",
        ];

        // Send email
        Mail::send('emails.verified_donation', $emailData, function ($message) use ($donorEmail, $chapterName) {
            $message->to($donorEmail)
                ->subject("Donation Receipt - {$chapterName}");
        });

        // Prepare and send SMS
        $smsMessage = "Hi {$donation->donor_name}, your PHP " . number_format($donation->amount, 2) .
            " donation for {$donation->cause} at {$chapterName} was received. " .
            "An email receipt has been sent. Thank you!";
        SmsHelper::sendSmsNotification($donorContact, $smsMessage);

        session()->forget('donation_data');
        return redirect()->route('donor.reqCash_map')->with(
            'success',
            'Donation successful! Please check your SMS/Email for the status and receipt.'
        );
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
        $donationData = session('quick_donation_data');
        if (!$donationData) {
            return redirect()->route('quick.cashForm')->with('error', 'No pending donation found.');
        }

        DB::transaction(function () use ($donationData) {
            // Create donation record
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
                'transaction_id' => 'Pay-' . now()->format('Ymd-His') . '-' . strtoupper(Str::random(6)),
            ]);

            // Add to pooled funds (quick donations always go to pooled funds)
            PooledFund::updateOrCreate(
                [
                    'chapter_id' => $donation->chapter_id,
                    'cause' => $donation->cause
                ],
                [
                    'total_cash' => DB::raw("total_cash + {$donation->amount}")
                ]
            );

            // Load chapter relationship
            $donation->load('chapter');
            $chapterName = $donation->chapter->chapter_name;

            // Get donor info
            $userAccount = UserAccount::find($donationData['donor_id']);
            $donorEmail = $userAccount->email;
            $donorContact = $donationData['contact'];

            // Prepare and send email
            Mail::send('emails.verified_donation', [
                'logoPath' => public_path('assets/img/systemLogo.png'),
                'chapter' => $chapterName,
                'donation' => $donation,
                'type' => 'cash',
                'emailMessage' => "Thank you for your donation of ₱" . number_format($donation->amount, 2) .
                    " to support {$donation->cause} at {$chapterName}. " .
                    "Your donation via {$donation->payment_method} has been successfully received."
            ], function ($message) use ($donorEmail, $chapterName) {
                $message->to($donorEmail)
                    ->subject("Donation Receipt - {$chapterName}");
            });

            // Send SMS
            SmsHelper::sendSmsNotification(
                $donorContact,
                "Hi {$donation->donor_name}, your PHP " . number_format($donation->amount, 2) .
                    " donation for {$donation->cause} at {$chapterName} was received. " .
                    "An email receipt has been sent. Thank you!"
            );
        });

        session()->forget('quick_donation_data');
        return redirect()->route('quick.cashForm')->with('success', 'Donation successful! Please check your SMS/Email for the status and receipt.');
    }

    public function quickPayMongoCancel(Request $request)
    {
        // Clear session if payment is canceled
        session()->forget('quick_donation_data');

        return redirect()->route('quick.cashForm')->with('error', 'Payment was canceled.');
    }
}
