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
        return view('users.donor.review', compact('existingTestimonial'));  
                  
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
    // Show the edit form with the current testimonial data
    public function edit($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('users.donor.edit', compact('testimonial'));
    }

    // Handle the update of the testimonial
    public function update(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $testimonial = Testimonial::findOrFail($id);
        $testimonial->content = $request->input('content');
        $testimonial->rating = $request->input('rating');
        $testimonial->save();

        return redirect()->route('donor.review')->with('success', 'Testimonial updated successfully!');
    }

    // Handle the deletion of the testimonial
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->route('donor.review')->with('success', 'Testimonial deleted successfully!');
    }


    
}