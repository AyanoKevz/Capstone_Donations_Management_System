<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Testimonial;
use App\Models\Event;
use App\Models\VolunteerActivity;
use App\Models\Inquiry;
use Exception;

class VolunteerController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Get the volunteer associated with the authenticated user
        $volunteer = $user->volunteer;

        // Check if the volunteer exists
        if (!$volunteer) {
            return redirect()->back()->with('error', 'Volunteer record not found.');
        }

        // Fetch assigned tasks for the volunteer
        $assignedTasks = VolunteerActivity::where('volunteer_id', $volunteer->id)
            ->where('status', 'accepted')
            ->get(['id', 'task_description', 'activity_date', 'hours_worked']);

        // Format tasks for FullCalendar
        $calendarEvents = [];
        foreach ($assignedTasks as $task) {
            $calendarEvents[] = [
                'id' => $task->id,
                'title' => $task->task_description,
                'start' => $task->activity_date,
                'extendedProps' => [
                    'hours_worked' => $task->hours_worked,
                ],
            ];
        }

        // Pass the data to the view
        return view('users.volunteer.home_volunteer', [
            'assignedTasks' => $assignedTasks->count(),
            'availableEvents' => Event::count(),
            'totalHoursWorked' => VolunteerActivity::where('volunteer_id', $volunteer->id)
                ->where('status', 'completed')
                ->sum('hours_worked'),
            'calendarEvents' => json_encode($calendarEvents), // Pass calendar events as JSON
        ]);
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
