<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Testimonial;

class DonorController extends Controller
{

    public function index()
    {
        return view('users.donor.home');
    }

    public function showChapters()
    {
        return view('users.donor.chapters');
    }
    public function review()
    {
        return view('users.donor.review');
    }
    public function store(Request $request)
{
    $request->validate([
        'content' => 'required|string|max:1000',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    $user = Auth::user(); // Get the authenticated user

    // Check if the user already has a testimonial
    $existingTestimonial = Testimonial::where('user_id', $user->id)
        ->where('user_type', 'Donor') // Ensure we check for this user type
        ->first();

    if ($existingTestimonial) {
        return redirect()->back()->with('error', 'You have already submitted a testimonial. You can edit or delete it.');
    }

    // Store testimonial if it doesn't exist
    Testimonial::create([
        'user_id' => $user->id,
        'user_type' => 'Donor', // Store only the model name, not the full class name
        'content' => $request->content,
        'rating' => $request->rating,
    ]);

    return redirect()->back()->with('success', 'Review submitted successfully!');
}
}
