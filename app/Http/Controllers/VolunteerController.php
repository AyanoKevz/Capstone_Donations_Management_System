<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Testimonial;
use App\Models\Event;
use App\Models\VolunteerActivity;
use App\Models\Inquiry;
use Exception;
use App\Helpers\SmsHelper;

class VolunteerController extends Controller
{
    public function index()
    {
        // Get the authenticated user
        $user = Auth::user();
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
            'totalHoursWorked' => VolunteerActivity::where('volunteer_id', $volunteer->id)
                ->where('status', 'completed')
                ->sum('hours_worked'),
            'PendingTask' => VolunteerActivity::where('volunteer_id', $volunteer->id)
                ->where('status', 'pending')
                ->count(), // Add this line for pending tasks count
            'calendarEvents' => json_encode($calendarEvents),
        ]);
    }

    public function showContactForm()
    {
        return view('users.volunteer.contact');
    }

    public function showAvailableTask()
    {
        $user = Auth::user();
        $volunteer = $user->volunteer;

        // Fetch all pending tasks for the volunteer
        $pendingTasks = VolunteerActivity::with(['donation', 'distribution'])
            ->where('volunteer_id', $volunteer->id)
            ->where('status', 'pending')
            ->get();

        return view('users.volunteer.available_task', [
            'pendingTasks' => $pendingTasks
        ]);
    }


    public function showAssTask()
    {
        $user = Auth::user();
        $volunteer = $user->volunteer;

        // Auto-activate (set to ongoing) tasks where date = today
        VolunteerActivity::where('volunteer_id', $volunteer->id)
            ->where('status', 'accepted')
            ->whereDate('activity_date', now()->toDateString())
            ->update(['status' => 'ongoing']); // Changed to 'ongoing'

        $assignedTasks = VolunteerActivity::with(['donation', 'distribution'])
            ->where('volunteer_id', $volunteer->id)
            ->whereIn('status', ['accepted', 'ongoing']) // Updated here too
            ->orderBy('activity_date', 'asc')
            ->get();

        return view('users.volunteer.assigned_task', [
            'assignedTasks' => $assignedTasks
        ]);
    }

    public function acceptTask($id)
    {
        $task = VolunteerActivity::findOrFail($id);
        $task->status = 'accepted';
        $task->save();

        // Send SMS to donor if this is a pickup task
        if ($task->donation_id) {
            $donation = $task->donation;
            $volunteer = $task->volunteer;
            $chapterName = $donation->chapter->name ?? 'our organization';

            // Parse the activity_date as Carbon before formatting
            $pickupDate = \Carbon\Carbon::parse($task->activity_date)->format('M j, Y');

            $smsMessage = "Hello {$donation->donor_name}, a volunteer {$volunteer->user->name} " .
                "has been assigned to pick up your donation on " .
                $pickupDate . ". " .
                "Please prepare your items at {$donation->pickup_address}. Thank you!";

            // Only send SMS if donor contact exists
            if ($donation->donor && $donation->donor->contact) {
                SmsHelper::sendSmsNotification($donation->donor->contact, $smsMessage);
            }
        }

        return redirect()->back()->with('success', 'Task accepted successfully!');
    }

    public function declineTask($id)
    {
        $task = VolunteerActivity::findOrFail($id);
        $task->status = 'declined';
        $task->save();

        return redirect()->back()->with('success', 'Task declined successfully!');
    }

    public function showCompletedTasks()
    {
        $user = Auth::user();
        $volunteer = $user->volunteer;

        $completedTasks = VolunteerActivity::with(['donation', 'distribution', 'donation.donor', 'donation.donationItems'])
            ->where('volunteer_id', $volunteer->id)
            ->where('status', 'completed')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('users.volunteer.completed_task', [
            'completedTasks' => $completedTasks
        ]);
    }

    public function showTestimonialForm()
    {
        $user = Auth::user();
        $testimonials = Testimonial::with('user.donor', 'user.volunteer')->get();
        $userTestimonial = Testimonial::where('user_id', $user->id)->first();

        return view('users.volunteer.testimonial', compact('testimonials', 'userTestimonial'));
    }
}
