<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Exception;

use Illuminate\Http\Request;

class DonorController extends Controller
{

    /* USER CONTACT SUBMIT VOL AND DONOR NA TO */
    public function UserContact(Request $request)
    {
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

        return redirect()->route('donor.contact_form');
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

    public function showTestimonialForm()
    {
        return view('users.donor.testimonial');
    }
}
