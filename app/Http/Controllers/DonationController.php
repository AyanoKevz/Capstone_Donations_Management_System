<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Donation;
use Illuminate\Support\Facades\Auth;
use App\Models\DonationRequest;
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

    public function submitRequest(Request $request)
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


    public function RequestMap(Request $request)
    {
        // Fetch the list of regions from the PSGC API
        $regions = Http::get('https://psgc.gitlab.io/api/regions')->json();

        $regionNames = collect($regions)
            ->pluck('name')
            ->unique()
            ->values()
            ->toArray();

        // Start with a base query for pending requests
        $query = DonationRequest::with(['location', 'items'])->where('status', 'Pending');

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

        return view('users.donor.request_map', [
            'donationRequests' => $donationRequests,
            'regions' => $regionNames,
        ]);
    }
}
