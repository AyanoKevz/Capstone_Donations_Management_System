<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Donation;
use App\Models\Chapter;
use App\Models\CashDonation;
use App\Models\DonationItem;
use Illuminate\Support\Facades\Auth;
use App\Models\DonationRequest;
use App\Models\FundRequest;
use App\Models\DonationRequestItem;
use App\Models\Location;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;


use Illuminate\Http\Request;

class DonationController extends Controller
{

    public function RequestForm()
    {
        return view('admin.request_form');
    }

    public function submitItemRequest(Request $request)
    {
        // Validate only the proof images and video
        $validated = $request->validate([
            'proof_photo_1' => 'required|file|mimes:jpeg,jpg,png|max:5120',
            'proof_photo_2' => 'required|file|mimes:jpeg,jpg,png|max:5120',
            'proof_video'   => 'required|file|mimes:mp4,mov,avi|max:30720'
        ]);

        try {
            // Get the logged-in admin
            $admin = Auth::guard('admin')->user();

            // Store the proof files
            $proofPhoto1 = $request->file('proof_photo_1')->store('donation_request', 'public');
            $proofPhoto2 = $request->file('proof_photo_2')->store('donation_request', 'public');
            $proofVideo = $request->file('proof_video')->store('donation_request', 'public');

            // Save location details
            $location = Location::create([
                'region'            => $request->region_name,
                'province'          => $request->province_name,
                'city_municipality' => $request->city_name,
                'barangay'          => $request->barangay_name,
                'latitude'          => $request->latitude,
                'longitude'         => $request->longitude,
            ]);

            // Insert donation request
            $donationRequest = DonationRequest::create([
                'created_by_admin_id' => $admin->id,
                'urgency'             => $request->urgency,
                'cause'               => $request->cause,
                'description'         => $request->description,
                'proof_photo_1'       => $proofPhoto1,
                'proof_photo_2'       => $proofPhoto2,
                'proof_video'         => $proofVideo,
                'status'              => 'pending',
                'location_id'         => $location->id
            ]);

            // Insert requested items
            if ($request->has('categories')) {
                foreach ($request->categories as $index => $category) {
                    DonationRequestItem::create([
                        'donation_request_id' => $donationRequest->id,
                        'category'            => $category,
                        'item'                => $request->items[$index],
                        'quantity'            => $request->quantities[$index],
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Donation request successfully submitted.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }



    public function submitCashRequest(Request $request)
    {
        // Validate only the proof media
        $validated = $request->validate([
            'proof_photo_1' => 'nullable|file|mimes:jpeg,jpg,png|max:5120',
            'proof_photo_2' => 'nullable|file|mimes:jpeg,jpg,png|max:5120',
            'proof_video' => 'nullable|file|mimes:mp4,mov,avi|max:30720',
        ]);

        try {
            // Get the logged-in admin
            $admin = Auth::guard('admin')->user();

            // Store the proof files in the 'donation_request' folder (same as inKind)
            $proofPhoto1 = $request->hasFile('proof_photo_1')
                ? $request->file('proof_photo_1')->store('donation_request', 'public')
                : null;

            $proofPhoto2 = $request->hasFile('proof_photo_2')
                ? $request->file('proof_photo_2')->store('donation_request', 'public')
                : null;

            $proofVideo = $request->hasFile('proof_video')
                ? $request->file('proof_video')->store('donation_request', 'public')
                : null;

            // Save location details
            $location = Location::create([
                'region' => $request->region_name,
                'province' => $request->province_name,
                'city_municipality' => $request->city_name,
                'barangay' => $request->barangay_name,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
            ]);

            // Insert fund request
            $fundRequest = FundRequest::create([
                'created_by_admin_id' => $admin->id,
                'location_id' => $location->id,
                'cause' => $request->cause,
                'urgency' => $request->urgency,
                'amount_needed' => $request->amount,
                'description' => $request->description,
                'proof_photo_1' => $proofPhoto1,
                'proof_photo_2' => $proofPhoto2,
                'proof_video' => $proofVideo,
                'status' => 'pending', // Default status
            ]);

            return redirect()->back()->with('success', 'Fund request successfully submitted.');
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error submitting fund request: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function RequestMapInKind(Request $request)
    {
        // Fetch the list of regions from the PSGC API
        $regions = Http::get('https://psgc.gitlab.io/api/regions')->json();
        $regionNames = collect($regions)->pluck('name')->unique()->values()->toArray();

        // Get authenticated donor
        $user = Auth::user();
        $donor = $user->donor;

        if (!$donor) {
            return redirect()->back()->with('error', 'Donor profile not found.');
        }

        // Get request IDs where the donor has donated but the donation is NOT received
        $pendingDonations = Donation::where('donor_id', $donor->id)
            ->where('status', '!=', 'Received') // Status is NOT received
            ->pluck('donation_request_id')
            ->toArray();

        // Start with a base query for pending requests
        $query = DonationRequest::with(['location', 'items', 'admin.chapter'])
            ->where('status', 'Pending')
            ->whereNotIn('id', $pendingDonations); // Hide requests where the donor has a pending donation

        // Apply filters
        if ($request->has('cause') && $request->cause !== 'General') {
            $query->where('cause', $request->cause);
        }
        if ($request->has('urgency') && $request->urgency !== 'General') {
            $query->where('urgency', $request->urgency);
        }
        if ($request->has('region') && $request->region !== 'General') {
            $region = $request->region;
            $query->whereHas('location', function ($q) use ($region) {
                $q->where('region', $region);
            });
        }

        $donationRequests = $query->get();
        $chapters = Chapter::all();

        // Calculate donated quantities
        $donationRequests->each(function ($request) {
            $request->items->each(function ($item) use ($request) {
                $donatedQuantity = DonationItem::where('donation_request_id', $request->id)
                    ->where('item', $item->item)
                    ->whereHas('donation', function ($q) {
                        $q->where('status', '!=', 'pending');
                    })
                    ->sum('quantity');
                $item->donated_quantity = $donatedQuantity;
            });
        });

        return view('users.donor.request_map', [
            'donationRequests' => $donationRequests,
            'regions' => $regionNames
        ]);
    }

    public function RequestMapInKindDonate(Request $request)
    {
        try {
            $user = Auth::user();
            $donor = $user->donor;

            if (!$donor) {
                return redirect()->back()->with('error', 'Donor profile not found.');
            }

            $proofImagePath = $request->file('proof_image')->store('proof_donation', 'public');

            // Create the donation record
            $donation = Donation::create([
                'donor_id' => $donor->id,
                'donor_name' => $request->has('anonymous_checkbox') && $request->anonymous_checkbox == 1
                    ? 'Anonymous'
                    : "{$donor->first_name} {$donor->last_name}",
                'chapter_id' => $request->chapter_id,
                'donation_request_id' => $request->donation_request_id,
                'cause' => $request->cause,
                'donation_method' => $request->donation_method,
                'pickup_address' => $request->donation_method === 'pickup' ? $request->pickup_address : null,
                'donation_datetime' => $request->donation_datetime,
                'proof_image' => $proofImagePath,
                'tracking_number' => strtoupper(uniqid('TRK-')),
                'status' => 'pending', // Ensure it starts as pending
            ]);

            // Save the donation items
            foreach ($request->quantity as $itemId => $quantity) {
                $item = DonationRequestItem::find($itemId);

                if ($item && $quantity > 0) {
                    // Create the donation item
                    DonationItem::create([
                        'donation_id' => $donation->id,
                        'donation_request_id' => $item->donation_request_id,
                        'category' => $item->category,
                        'item' => $item->item,
                        'quantity' => $quantity,
                    ]);
                }
            }

            if ($donation->donation_request_id) {
                $donationRequest = DonationRequest::find($donation->donation_request_id);
                if ($donationRequest) {
                    $donationRequest->checkIfFulfilled(); // Check and update the request status
                }
            }

            return redirect()->back()->with('success', 'Donation submitted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }


    public function RequestMapCash(Request $request)
    {
        // Fetch regions from the PSGC API
        $regions = Http::get('https://psgc.gitlab.io/api/regions')->json();
        $regionNames = collect($regions)->pluck('name')->unique()->values()->toArray();

        // Get authenticated donor
        $user = Auth::user();
        $donor = $user->donor;

        if (!$donor) {
            return redirect()->back()->with('error', 'Donor profile not found.');
        }

        // Get fund request IDs where the donor has already donated cash
        $pendingCashDonations = CashDonation::where('donor_id', $donor->id)
            ->where('status', '!=', 'Received') // Status is NOT received
            ->pluck('fund_request_id')
            ->toArray();

        // Start with a base query for fund requests
        $query = FundRequest::with(['location', 'cashDonations', 'admin.chapter'])
            ->where('status', 'Pending')
            ->whereNotIn('id', $pendingCashDonations);

        // Apply filters
        if ($request->has('cause') && $request->cause !== 'General') {
            $query->where('cause', $request->cause);
        }
        if ($request->has('urgency') && $request->urgency !== 'General') {
            $query->where('urgency', $request->urgency);
        }
        if ($request->has('region') && $request->region !== 'General') {
            $region = $request->region;
            $query->whereHas('location', function ($q) use ($region) {
                $q->where('region', $region);
            });
        }

        // Get the fund requests
        $fundRequests = $query->get();

        // Calculate amount_raised for each fund request
        $fundRequests->each(function ($fundRequest) {
            // Get total cash donations for this fund request
            $totalDonated = $fundRequest->cashDonations()->sum('amount');

            // Attach calculated values
            $fundRequest->amount_raised = $totalDonated; // Store the raised amount
            $fundRequest->remaining_amount = max(0, ($fundRequest->amount_needed ?? 0) - $totalDonated);
        });


        return view('users.donor.request_map_cash', [
            'fundRequests' => $fundRequests,
            'regions' => $regionNames,
        ]);
    }


    public function MapDropOffDonateCash(Request $request)
    {
        $user = Auth::user();
        $donor = $user->donor;

        if (!$donor) {
            return back()->with('error', 'Donor profile not found.');
        }

        // Generate a transaction ID for tracking
        $transactionId = 'DropOff-' . now()->format('Ymd-His') . '-' . strtoupper(Str::random(6));

        // Insert drop-off donation into the database
        $donation = CashDonation::create([
            'donor_id' => $donor->id,
            'donor_name' => $request->has('anonymous_checkbox') && $request->anonymous_checkbox == 1 ? 'Anonymous' : "{$donor->first_name} {$donor->last_name}",
            'chapter_id' => $request->chapter_id,
            'fund_request_id' => $request->fund_request_id,
            'cause' => $request->cause,
            'amount' => $request->amount,
            'donation_method' => 'drop-off',
            'payment_method' => null,
            'payment_status' => null,
            'status' => 'pending',
            'transaction_id' => $transactionId,
        ]);

        return redirect()->route('donor.reqCash_map')->with('success', 'Donation successful! Thank you for your support.');
    }

    public function quickInKindDonate(Request $request)
    {
        try {
            $user = Auth::user();
            $donor = $user->donor;

            if (!$donor) {
                return redirect()->back()->with('error', 'Donor profile not found.');
            }
            $proofImagePath = $request->file('proof_image')->store('proof_donation', 'public');

            // Create the donation record
            $donation = Donation::create([
                'donor_id' => $donor->id,
                'donor_name' => $request->has('anonymous_checkbox') && $request->anonymous_checkbox == 1 ? 'Anonymous' : "{$donor->first_name} {$donor->last_name}",
                'chapter_id' => $request->chapter_id,
                'cause' => $request->cause,
                'donation_method' => $request->donation_method,
                'pickup_address' => $request->donation_method === 'pickup' ? $request->pickup_address : null,
                'donation_datetime' => $request->donation_datetime,
                'proof_image' => $proofImagePath,
                'tracking_number' => strtoupper(uniqid('TRK-')),
            ]);

            // Save the donation items
            if ($request->has('categories')) {
                foreach ($request->categories as $index => $category) {
                    $item = $request->items[$index];
                    $quantity = $request->quantities[$index];

                    if ($item && $quantity > 0) {
                        DonationItem::create([
                            'donation_id' => $donation->id,
                            'category' => $category,
                            'item' => $item,
                            'quantity' => $quantity,
                        ]);
                    }
                }
            }

            return redirect()->back()->with('success', 'Quick donation submitted successfully. A receipt will be provided to your email once the donation is verified.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }


    public function quickDropOff(Request $request)
    {
        $user = Auth::user();
        $donor = $user->donor;

        if (!$donor) {
            return back()->with('error', 'Donor profile not found.');
        }

        // Generate a transaction ID for tracking
        $transactionId = 'DropOff-' . now()->format('Ymd-His') . '-' . strtoupper(Str::random(6));

        // Insert Quick Drop-off Donation into the Database
        CashDonation::create([
            'donor_id' => $donor->id,
            'donor_name' => $request->has('anonymous_checkbox') && $request->anonymous_checkbox == 1 ? 'Anonymous' : "{$donor->first_name} {$donor->last_name}",
            'chapter_id' => $request->chapter_id,
            'cause' => $request->cause,
            'amount' => $request->amount,
            'donation_method' => 'drop-off',
            'payment_method' => null, // No payment method for drop-off
            'payment_status' => null, // No payment status for drop-off
            'status' => 'pending', // Set to pending until admin confirms
            'transaction_id' => $transactionId,
        ]);

        return redirect()->route('quick.cashForm')->with('success', 'Quick donation submitted successfully. A receipt will be provided to your email once the donation is verified.');
    }
}
