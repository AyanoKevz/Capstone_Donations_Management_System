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
            'proof_photo_1' => 'nullable|file|mimes:jpeg,jpg,png|max:5120', // Optional
            'proof_photo_2' => 'nullable|file|mimes:jpeg,jpg,png|max:5120', // Optional
            'proof_video' => 'nullable|file|mimes:mp4,mov,avi|max:30720', // Optional
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
        $query = DonationRequest::with(['location', 'items'])
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
                    ->sum('quantity');
                $item->donated_quantity = $donatedQuantity;
            });
        });

        return view('users.donor.request_map', [
            'donationRequests' => $donationRequests,
            'regions' => $regionNames,
            'chapters' => $chapters
        ]);
    }


    public function RequestMapCash(Request $request)
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

        // Get fund request IDs where the donor has already donated cash
        $pendingCashDonations = CashDonation::where('donor_id', $donor->id)
            ->where('status', '!=', 'Received') // Status is NOT received
            ->pluck('fund_request_id')
            ->toArray();

        // Start with a base query for fund requests
        $query = FundRequest::with(['location', 'cashDonations'])
            ->where('status', 'Pending')
            ->whereNotIn('id', $pendingCashDonations); // Exclude requests where the donor has a pending cash donation

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
            $fundRequest->amount_raised = $fundRequest->cashDonations->sum('amount');
        });

        $chapters = Chapter::all();

        return view('users.donor.request_map_cash', [
            'fundRequests' => $fundRequests,
            'regions' => $regionNames,
            'chapters' => $chapters
        ]);
    }


    public function RequestMapInKindDonate(Request $request)
    {
        $request->validate([
            'cause' => 'required|string',
            'donation_method' => 'required|in:pickup,drop-off',
            'donation_datetime' => 'required|date',
            'chapter_id' => 'required|exists:chapter,id',
            'proof_image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'quantity' => 'required|array',
            'quantity.*' => 'required|integer|min:1',
            'donation_request_id' => 'required|exists:donation_request,id',
        ]);

        try {
            $user = Auth::user();
            $donor = $user->donor;

            if (!$donor) {
                return redirect()->back()->with('error', 'Donor profile not found.');
            }

            // Store the proof image
            $proofImagePath = null;
            if ($request->hasFile('proof_image')) {
                $proofImagePath = $request->file('proof_image')->store('proof_donation', 'public');
            }

            // Create the donation record
            $donation = Donation::create([
                'donor_id' => $donor->id,
                'donor_name' => $request->has('anonymous_checkbox') ? 'Anonymous' : "{$donor->first_name} {$donor->last_name}",
                'chapter_id' => $request->chapter_id,
                'donation_request_id' => $request->donation_request_id,
                'cause' => $request->cause,
                'donation_method' => $request->donation_method,
                'pickup_address' => $request->donation_method === 'pickup' ? $request->pickup_address : null,
                'donation_datetime' => $request->donation_datetime,
                'proof_image' => $proofImagePath,
                'tracking_number' => strtoupper(uniqid('TRK-')),
            ]);

            // Save the donation items
            foreach ($request->quantity as $itemId => $quantity) {
                $item = DonationRequestItem::find($itemId);

                if ($item && $quantity > 0) {
                    // Calculate the total donated quantity for this item
                    $totalDonated = DonationItem::where('donation_request_id', $item->donation_request_id)
                        ->where('item', $item->item)
                        ->sum('quantity');

                    // Calculate the remaining quantity needed
                    $remainingQuantity = $item->quantity - $totalDonated;

                    // Ensure the donated quantity does not exceed the remaining quantity
                    if ($quantity > $remainingQuantity) {
                        return redirect()->back()->with('error', "Cannot donate more than {$remainingQuantity} for {$item->item}.");
                    }

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

            return redirect()->back()->with('success', 'Donation submitted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
