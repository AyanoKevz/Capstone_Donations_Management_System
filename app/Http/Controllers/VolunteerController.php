<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Testimonial;
use App\Models\Inquiry;
use App\Models\VolunteerActivity; // Add the VolunteerActivity model
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

    public function myTask()
    {
        $user = Auth::user();

        // Fetch tasks specific to the logged-in volunteer
        $tasks = VolunteerActivity::where('volunteer_id', $user->id)
            ->select('id', 'task_description', 'hours_worked', 'event_id', 'distribution_id', 'created_at', 'updated_at')
            ->get();

        return view('users.volunteer.my_task', compact('tasks'));
    }

    public function showTestimonialForm()
    {
        $user = Auth::user();
        $testimonials = Testimonial::with('user.donor', 'user.volunteer')->get();
        $userTestimonial = Testimonial::where('user_id', $user->id)->first();

        return view('users.volunteer.testimonial', compact('testimonials', 'userTestimonial'));
    }
}

