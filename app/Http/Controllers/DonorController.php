<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Testimonial;
use App\Models\Inquiry;
use App\Models\Donation;
use App\Models\Chapter;
use App\Models\CashDonation;
use App\Models\DonationItem;
use App\Models\DonationRequest;
use App\Models\FundRequest;
use App\Models\DonationRequestItem;
use App\Models\Location;
use Illuminate\Support\Facades\Http;
use Exception;
use Illuminate\Http\Request;

class DonorController extends Controller
{

    /* USER CONTACT SUBMIT VOL AND DONOR NA TO */
    public function UserContact(Request $request)
    {

        $user = Auth::user();


        $userType = $user->donor ? 'Donor' : ($user->volunteer ? 'Volunteer' : null);

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'contact' => 'required|string|max:140',
            'subject' => 'nullable|string|max:140',
            'message' => 'required|string',
        ]);

        $validated['status'] = 'unread';
        $validated['submitted_at'] = now();

        try {
            Inquiry::create($validated);
            session()->flash('success', 'Your inquiry was successfully submitted.');
        } catch (Exception $e) {
            session()->flash('error', 'An error occurred while submitting your inquiry.');
        }

        if ($userType === 'Donor') {
            return redirect()->route('donor.contact_form');
        } elseif ($userType === 'Volunteer') {
            return redirect()->route('volunteer.contact_form');
        }
    }


    public function StoreTestimonials(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:1000',
        ]);

        $user = Auth::user();


        $userType = $user->donor ? 'Donor' : ($user->volunteer ? 'Volunteer' : null);

        if (!$userType) {
            return redirect()->back()->withErrors(['error' => 'User type not recognized.']);
        }

        Testimonial::create([
            'user_id' => $user->id,
            'user_type' => $userType,
            'content' => $request->input('content'),
            'rating' => $request->input('rating'),
        ]);

        // Redirect based on user type
        if ($userType === 'Donor') {
            return redirect()->route('donor.testi_form')->with('success', 'Thank you for your feedback!');
        } elseif ($userType === 'Volunteer') {
            return redirect()->route('volunteer.testi_form')->with('success', 'Thank you for your feedback!.');
        }
    }

    public function updateTestimonial(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string|max:1000',
        ]);

        $testimonial = Testimonial::findOrFail($id);

        if ($testimonial->user_id !== Auth::id()) {
            return redirect()->back()->withErrors(['error' => 'Unauthorized action.']);
        }

        $testimonial->update([
            'rating' => $request->input('rating'),
            'content' => $request->input('content'),
        ]);


        $user = Auth::user();
        $userType = $user->donor ? 'Donor' : ($user->volunteer ? 'Volunteer' : null);

        if ($userType === 'Donor') {
            return redirect()->route('donor.testi_form')->with('success', 'Your testimonial has been updated.');
        } elseif ($userType === 'Volunteer') {
            return redirect()->route('volunteer.testi_form')->with('success', 'Your testimonial has been updated.');
        }

        // Fallback for unknown user type
        return redirect()->back()->withErrors(['error' => 'User type not recognized.']);
    }


    public function deleteTestimonial(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        if ($testimonial->user_id !== Auth::id()) {
            return redirect()->back()->withErrors(['error' => 'Unauthorized action.']);
        }

        $testimonial->delete();

        $user = Auth::user();
        $userType = $user->donor ? 'Donor' : ($user->volunteer ? 'Volunteer' : null);

        // Redirect based on user type
        if ($userType === 'Donor') {
            return redirect()->route('donor.home')->with('success', 'Your testimonial has been deleted');
        } elseif ($userType === 'Volunteer') {
            return redirect()->route('volunteer.home')->with('success', 'Your testimonial has been deleted!');
        }

        return redirect()->back()->withErrors(['error' => 'User type not recognized.']);
    }


    public function index()
    {
        return view('users.donor.home');
    }

    public function showChapters()
    {
        return view('users.donor.chapters');
    }

    public function showContactForm()
    {
        return view('users.donor.contact');
    }

    public function causes()
    {
        return view('users.donor.causes');
    }

    public function showTestimonialForm()
    {
        $user = Auth::user();
        $testimonials = Testimonial::with('user.donor', 'user.volunteer')->get();
        $userTestimonial = Testimonial::where('user_id', $user->id)->first();

        return view('users.donor.testimonial', compact('testimonials', 'userTestimonial'));
    }

    public function quickInKindForm()
    {
        $chapters = Chapter::all();
        return view('users.donor.quick_InKind', compact('chapters'));
    }

    public function quickcashForm()
    {
        $chapters = Chapter::all();
        return view('users.donor.quick_cash', compact('chapters'));
    }



    public function requestInKind(Request $request)
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

        return view('users.donor.requestInkind', [
            'donationRequests' => $donationRequests,
            'regions' => $regionNames
        ]);
    }
}
