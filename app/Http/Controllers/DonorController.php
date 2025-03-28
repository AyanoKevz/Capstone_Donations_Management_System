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

    public function donationStatusList(Request $request)
    {
        $user = Auth::user();

        // Base queries
        $queryInKind = Donation::where('donor_id', $user->id)
            ->whereIn('status', ['pending', 'ongoing']); // Only pending & ongoing

        $queryCash = CashDonation::where('donor_id', $user->id)
            ->whereIn('status', ['pending', 'ongoing']); // Only pending & ongoing

        // Filtering by Type (Request / Quick)
        $type = $request->query('type', 'all');
        if ($type === 'request') {
            $queryInKind->whereNotNull('donation_request_id');
            $queryCash->whereNotNull('fund_request_id');
        } elseif ($type === 'quick') {
            $queryInKind->whereNull('donation_request_id');
            $queryCash->whereNull('fund_request_id');
        }

        // Filtering by Donation Type (In-Kind / Cash)
        $donationType = $request->query('donation_type', 'all');
        if ($donationType === 'in-kind') {
            $donations = $queryInKind->get();
        } elseif ($donationType === 'cash') {
            $donations = $queryCash->get();
        } else {
            $donations = $queryInKind->get()->merge($queryCash->get());
        }

        // Filtering by Status (Pending / Ongoing / All)
        $status = $request->query('status', 'all');
        if ($status !== 'all') {
            $donations = $donations->where('status', $status);
        }

        return view('users.donor.donationStatusList', compact('donations'));
    }


    public function completeDonations(Request $request)
    {
        $user = Auth::user();

        // Base queries
        $queryInKind = Donation::where('donor_id', $user->id)
            ->whereIn('status', ['received', 'distributed', 'unverified']);

        $queryCash = CashDonation::where('donor_id', $user->id)
            ->whereIn('status', ['received', 'distributed', 'unverified']);

        // Filtering by Type (Request / Quick)
        $type = $request->query('type', 'all');
        if ($type === 'request') {
            $queryInKind->whereNotNull('donation_request_id');
            $queryCash->whereNotNull('fund_request_id');
        } elseif ($type === 'quick') {
            $queryInKind->whereNull('donation_request_id');
            $queryCash->whereNull('fund_request_id');
        }

        // Filtering by Donation Type (In-Kind / Cash)
        $donationType = $request->query('donation_type', 'all');
        if ($donationType === 'in-kind') {
            $donations = $queryInKind->get();
        } elseif ($donationType === 'cash') {
            $donations = $queryCash->get();
        } else {
            $donations = $queryInKind->get()->merge($queryCash->get());
        }

        // Filtering by Status (Received / Distributed / Unverified)
        $status = $request->query('status', 'all');
        if ($status !== 'all') {
            $donations = $donations->where('status', $status);
        }

        return view('users.donor.complete', compact('donations'));
    }

    public function showCashDonationDetails($id)
    {
        $cashDonation = CashDonation::findOrFail($id);
        return view('users.donor.cash_details', compact('cashDonation'));
    }

    public function showInKindDonationDetails($id)
    {
        $inKindDonation = Donation::with('donationItems')->findOrFail($id);
        return view('users.donor.inkind_details', compact('inKindDonation'));
    }
}
