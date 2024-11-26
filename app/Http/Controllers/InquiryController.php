<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;
use Illuminate\Support\Facades\Log;

class InquiryController extends Controller
{
    public function index()
    {
        return view('homepage.contact');
    }

    public function insert(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'contact' => 'required|string|max:100',
            'subject' => 'nullable|string|max:140',
            'message' => 'required|string',
        ]);

        $validated['status'] = 'unread';
        $validated['submitted_at'] = now();

        try {
            // Insert the data into the inquiry table
            Inquiry::create($validated);

            session()->flash('success', 'Your inquiry was successfully submitted.');
            session()->flash('success', 'Your inquiry was successfully submitted.');
        } catch (\Exception $e) {
            Log::error('Inquiry insert error: ' . $e->getMessage());
            session()->flash('error', 'An error occurred while submitting your inquiry.');
        }

        // Redirect to the contact page
        return redirect()->route('contact');
    }
}
