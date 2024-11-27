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
            'contact' => 'required|string|max:140',
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

        return redirect()->route('contact');
    }

    public function inbox(Request $request)
    {
        $status = $request->query('status', 'all');
        $query = Inquiry::query();

        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $inquiries = $query->orderBy('submitted_at', 'desc')->paginate(10, ['*'], 'page', null)->onEachSide(1);
        $total = Inquiry::count();

        return view('admin.inquiries', compact('inquiries', 'total', 'status'));
    }

    public function deleteSelected(Request $request)
    {
        $ids = $request->input('selected');
        if ($ids) {
            Inquiry::whereIn('inquiry_id', $ids)->delete();
            return back()->with('success', 'Selected inquiries were deleted successfully.');
        }

        return back()->with('error', 'No inquiries selected for deletion.');
    }


    public function inquiriesRead($id)
    {
        // Find the inquiry by ID
        $inquiry = Inquiry::where('inquiry_id', $id)->firstOrFail();


        if ($inquiry->status === 'unread') {
            $inquiry->status = 'read';
            $inquiry->save();
        }

        return view('admin.inquiries_read', compact('inquiry'));
    }
}
