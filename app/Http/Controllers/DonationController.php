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
use App\Helpers\SmsHelper;


use Illuminate\Http\Request;

class DonationController extends Controller
{

    public function RequestForm()
    {
        return view('admin.request_form');
    }

    public function submitItemRequest(Request $request)
    {
        $validated = $request->validate([
            'proof_photo_1' => 'required|file|mimes:jpeg,jpg,png|max:5120',
            'proof_photo_2' => 'required|file|mimes:jpeg,jpg,png|max:5120',
            'proof_video'   => 'required|file|mimes:mp4,mov,avi|max:30720',
        ]);

        try {
            $admin = Auth::guard('admin')->user();

            // Normalize location data (preserve original case)
            $location = Location::firstOrCreate([
                'region'            => trim($request->region_name), // Remove strtolower()
                'province'          => trim($request->province_name), // Remove strtolower()
                'city_municipality' => trim($request->city_name), // Remove strtolower()
                'barangay'          => trim($request->barangay_name), // Remove strtolower()
                'latitude'          => round($request->latitude, 6),
                'longitude'         => round($request->longitude, 6),
            ]);

            // Check if a donation request with the same location, cause, and pending status already exists
            if (DonationRequest::where('location_id', $location->id)
                ->where('cause', $request->cause)
                ->where('status', 'Pending')
                ->exists()
            ) {
                return redirect()->back()->with('error', 'A pending donation request with the same location and cause already exists.');
            }

            // Store the proof files
            $proofPhoto1 = $request->file('proof_photo_1')->store('donation_request', 'public');
            $proofPhoto2 = $request->file('proof_photo_2')->store('donation_request', 'public');
            $proofVideo = $request->file('proof_video')->store('donation_request', 'public');

            // Insert donation request
            $donationRequest = DonationRequest::create([
                'created_by_admin_id' => $admin->id,
                'urgency'             => $request->urgency,
                'cause'               => $request->cause,
                'description'         => $request->description,
                'proof_photo_1'       => $proofPhoto1,
                'proof_photo_2'       => $proofPhoto2,
                'proof_video'         => $proofVideo,
                'status'              => 'Pending',
                'location_id'         => $location->id,
                'valid_until'         => $request->valid_until,
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
            Log::error('Error submitting donation request:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }


    public function submitCashRequest(Request $request)
    {
        // Validate inputs including the new casualty_cost and valid_until fields
        $validated = $request->validate([
            'proof_photo_1' => 'nullable|file|mimes:jpeg,jpg,png|max:5120',
            'proof_photo_2' => 'nullable|file|mimes:jpeg,jpg,png|max:5120',
            'proof_video' => 'nullable|file|mimes:mp4,mov,avi|max:30720',
        ]);

        try {
            // Get the logged-in admin
            $admin = Auth::guard('admin')->user();

            // Normalize location data (preserve original case)
            $locationData = [
                'region'            => trim($request->region_name),
                'province'          => trim($request->province_name),
                'city_municipality' => trim($request->city_name),
                'barangay'          => trim($request->barangay_name),
                'latitude'          => round($request->latitude, 6),
                'longitude'         => round($request->longitude, 6),
            ];

            // Check if a location with the same details already exists
            $location = Location::firstOrCreate($locationData);

            // Check if a fund request with the same location, cause, and pending status already exists
            $existingRequest = FundRequest::where('location_id', $location->id)
                ->where('cause', $request->cause)
                ->where('status', 'pending')
                ->first();

            if ($existingRequest) {
                return redirect()->back()->with('error', 'A pending fund request with the same location and cause already exists.');
            }

            // Store proof files
            $proofPhoto1 = $request->hasFile('proof_photo_1')
                ? $request->file('proof_photo_1')->store('donation_request', 'public')
                : null;

            $proofPhoto2 = $request->hasFile('proof_photo_2')
                ? $request->file('proof_photo_2')->store('donation_request', 'public')
                : null;

            $proofVideo = $request->hasFile('proof_video')
                ? $request->file('proof_video')->store('donation_request', 'public')
                : null;

            // Insert fund request
            FundRequest::create([
                'created_by_admin_id' => $admin->id,
                'location_id' => $location->id,
                'cause' => $request->cause,
                'urgency' => $request->urgency,
                'casualty_cost' => $request->casualty_cost,
                'valid_until' => $request->valid_until,
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
            ->whereNotNull('donation_request_id') // Exclude donations with no request ID
            ->pluck('donation_request_id')
            ->toArray();

        // Update expired and unfulfilled requests to Unfulfilled
        DonationRequest::where('status', 'Pending') // Only Pending requests
            ->where('valid_until', '<', now()->toDateString()) // Expired requests
            ->update(['status' => 'Unfulfilled']);

        // Start with a base query for pending requests with valid dates
        $query = DonationRequest::with(['location', 'items', 'admin.chapter'])
            ->where('status', 'Pending')
            ->where('valid_until', '>=', now()->toDateString()) // Only valid dates (future or today)
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

        // Fetch the filtered donation requests
        $donationRequests = $query->get();
        $chapters = Chapter::all();

        // Calculate donated quantities for each item in the requests
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

        // Return the view with the donation requests and regions
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
                'status' => 'pending',
            ]);

            foreach ($request->quantity as $itemId => $quantity) {
                $item = DonationRequestItem::find($itemId);
                if ($item && $quantity > 0) {
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
                    $donationRequest->checkIfFulfilled();
                }
            }

            $chapter = Chapter::find($request->chapter_id);
            $chapterName = $chapter->chapter_name;

            $message = "Hello {$donation->donor_name}, your in-Kind donation in a request at {$chapterName} is under verification. Please check your Email/SMS for updates. Thank you!";
            SmsHelper::sendSmsNotification($donor->contact, $message);

            return redirect()->back()->with('success', 'Thank your for your donation. Please check your SMS/Email for updates once verification is completed.');
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
            ->where('status', '!=', 'Received')
            ->whereNotNull('fund_request_id')
            ->pluck('fund_request_id')
            ->toArray();

        FundRequest::where('status', 'Pending') // Only Pending requests
            ->where('valid_until', '<', now()->toDateString()) // Expired requests
            ->each(function ($request) {
                // Check if the request has any donations
                $hasDonations = $request->cashDonations()->exists();
                $request->status = $hasDonations ? 'Fulfilled' : 'Unfulfilled';
                $request->save();
            });

        $query = FundRequest::with(['location', 'cashDonations', 'admin.chapter'])
            ->where('status', 'Pending')
            ->where('valid_until', '>=', now()->toDateString()) // Ensure active requests
            ->whereNotIn('id', $pendingCashDonations);

        // Apply filters
        if ($request->has('cause') && $request->cause !== 'General') {
            $query->whereNotNull('cause')->where('cause', $request->cause);
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

        $fundRequests->each(function ($fundRequest) {
            $totalDonated = $fundRequest->cashDonations()
                ->where('status', 'received')
                ->sum('amount');
            $fundRequest->amount_raised = $totalDonated;
        });

        return view('users.donor.request_map_cash', [
            'fundRequests' => $fundRequests,
            'regions' => $regionNames,
        ]);
    }

    public function MapDropOffDonateCash(Request $request)
    {
        try {
            $user = Auth::user();
            $donor = $user->donor;

            if (!$donor) {
                return back()->with('error', 'Donor profile not found.');
            }

            $transactionId = 'DropOff-' . now()->format('Ymd-His') . '-' . strtoupper(Str::random(6));

            if ($request->hasFile('proof_image')) {
                $proofImagePath = $request->file('proof_image')->store('proof_donation', 'public');
            }

            $donation = CashDonation::create([
                'donor_id' => $donor->id,
                'donor_name' => $request->has('anonymous_checkbox') && $request->anonymous_checkbox == 1
                    ? 'Anonymous'
                    : "{$donor->first_name} {$donor->last_name}",
                'chapter_id' => $request->chapter_id,
                'fund_request_id' => $request->fund_request_id,
                'cause' => $request->cause,
                'amount' => $request->amount,
                'donation_method' => 'drop-off',
                'payment_method' => null,
                'payment_status' => null,
                'status' => 'pending',
                'transaction_id' => $transactionId,
                'proof_image' => $proofImagePath, // Save the proof image path
            ]);

            // Fetch chapter name
            $chapter = Chapter::find($request->chapter_id);
            $chapterName = $chapter->chapter_name;

            $message = "Hello {$donation->donor_name}, your cash drop-off donation of PHP {$donation->amount} for {$donation->cause} is under verification at {$chapterName}. Please check your Email/SMS for updates. Thank you!";
            SmsHelper::sendSmsNotification($donor->contact, $message);

            return redirect()->route('donor.reqCash_map')->with('success', 'Donation successful! Thank you. Please check your Email/SMS for updates once verification is completed.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
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
                'donor_name' => $request->has('anonymous_checkbox') && $request->anonymous_checkbox == 1
                    ? 'Anonymous'
                    : "{$donor->first_name} {$donor->last_name}",
                'chapter_id' => $request->chapter_id,
                'cause' => $request->cause,
                'donation_method' => $request->donation_method,
                'pickup_address' => $request->donation_method === 'pickup' ? $request->pickup_address : null,
                'donation_datetime' => $request->donation_datetime,
                'proof_image' => $proofImagePath,
                'tracking_number' => strtoupper(uniqid('TRK-')),
                'status' => 'pending',
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

            // Fetch chapter name
            $chapter = Chapter::find($request->chapter_id);
            $chapterName = $chapter->chapter_name;

            // Send SMS notification
            $message = "Hello {$donation->donor_name}, your quick in-kind donation via {$donation->donation_method} is under verification by {$chapterName}. Please check your email for updates. Thank you!";
            SmsHelper::sendSmsNotification($donor->contact, $message);

            return redirect()->back()->with('success', 'Thank your for your donation. Please check your email for updates once verification is completed.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function quickDropOff(Request $request)
    {
        try {
            $user = Auth::user();
            $donor = $user->donor;

            if (!$donor) {
                return back()->with('error', 'Donor profile not found.');
            }

            // Generate a transaction ID for tracking
            $transactionId = 'DropOff-' . now()->format('Ymd-His') . '-' . strtoupper(Str::random(6));

            if ($request->hasFile('proof_image')) {
                $proofImagePath = $request->file('proof_image')->store('proof_donation', 'public');
            }

            // Insert Quick Drop-off Donation into the Database
            $donation = CashDonation::create([
                'donor_id' => $donor->id,
                'donor_name' => $request->has('anonymous_checkbox') && $request->anonymous_checkbox == 1
                    ? 'Anonymous'
                    : "{$donor->first_name} {$donor->last_name}",
                'chapter_id' => $request->chapter_id,
                'cause' => $request->cause,
                'amount' => $request->amount,
                'donation_method' => 'drop-off',
                'payment_method' => null,
                'payment_status' => null,
                'status' => 'pending',
                'transaction_id' => $transactionId,
                'proof_image' => $proofImagePath, // Store image path in DB
            ]);

            // Fetch chapter name
            $chapter = Chapter::find($request->chapter_id);
            $chapterName = $chapter->chapter_name;

            // Send SMS notification
            $message = "Hello {$donation->donor_name}, your quick cash drop-off donation of PHP {$donation->amount} for {$donation->cause} is under verification at {$chapterName}. Please check your Email/SMS for updates. Thank you!";
            SmsHelper::sendSmsNotification($donor->contact, $message);

            return redirect()->route('quick.cashForm')->with('success', 'Quick donation submitted successfully. Please check your email for updates once verification is completed.');
        } catch (\Exception $e) {
            return redirect()->route('quick.cashForm')->with('error', 'Something went wrong. Please try again.');
        }
    }


    public function fetchLastCashDonation()
    {
        $user = Auth::user();

        // Get the latest quick cash donation (without a fund_request_id)
        $lastDonation = CashDonation::where('donor_id', $user->donor->id)
            ->whereNull('fund_request_id') // Ensure it is a quick cash donation
            ->latest()
            ->first();

        if (!$lastDonation) {
            return response()->json(['error' => 'No previous quick cash donation found.'], 404);
        }

        return response()->json([
            'cause' => $lastDonation->cause,
            'chapter_id' => $lastDonation->chapter_id,
            'amount' => $lastDonation->amount,
            'donation_method' => $lastDonation->donation_method,
            'payment_method' => $lastDonation->payment_method,
        ]);
    }


    public function fetchLastInKindDonation()
    {
        $user = Auth::user();

        if (!$user || !$user->donor) {
            return response()->json([
                'success' => false,
                'message' => 'User not found or not a donor'
            ]);
        }

        $lastDonation = Donation::where('donor_id', $user->donor->id)
            ->whereNull('donation_request_id')
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$lastDonation) {
            return response()->json([
                'success' => false,
                'message' => 'No previous quick donations found'
            ]);
        }

        $donationItems = DonationItem::where('donation_id', $lastDonation->id)->get();

        $lastDetails = [
            'cause' => $lastDonation->cause,
            'donation_method' => $lastDonation->donation_method,
            'chapter_id' => $lastDonation->chapter_id,
            'pickup_address' => $lastDonation->pickup_address,
            'items' => $donationItems->map(function ($item) {
                return [
                    'category' => $item->category,
                    'item' => $item->item,
                    'quantity' => $item->quantity
                ];
            })
        ];

        return response()->json([
            'success' => true,
            'data' => $lastDetails
        ]);
    }
}
