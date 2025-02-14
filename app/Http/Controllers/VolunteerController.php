<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Testimonial;
use App\Models\Inquiry;
use Exception;

class VolunteerController extends Controller
{
    public function index()
    {
        return view('users.volunteer.home_volunteer');
    }

    public function showContactForm()
    {
        return view('users.volunteer.contact');
    }

    public function showTestimonialForm()
    {
        $user = Auth::user();
        $testimonials = Testimonial::with('user.donor', 'user.volunteer')->get();
        $userTestimonial = Testimonial::where('user_id', $user->id)->first();

        return view('users.volunteer.testimonial', compact('testimonials', 'userTestimonial'));
    }
}
