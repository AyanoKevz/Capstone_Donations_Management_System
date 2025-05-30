<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\AccountVerifiedMail;
use App\Mail\AccountRejectedMail;
use App\Mail\AppointmentMail;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAccount;
use App\Models\Appointment;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use App\Helpers\SmsHelper;

class VerifyAcct extends Controller
{
    public function showInactiveAccounts(Request $request)
    {
        // Get the logged-in admin
        $admin = Auth::guard('admin')->user();

        // Retrieve the filter value from the query parameter
        $filter = $request->query('role_name', 'all');

        // Base query for inactive accounts
        $query = UserAccount::with(['roles', 'volunteer.chapter', 'donor'])
            ->where('is_verified', false) // Only inactive accounts
            ->where(function ($query) use ($admin) {
                // Include volunteers from the same chapter as the admin
                $query->whereHas('roles', function ($roleQuery) {
                    $roleQuery->where('role_name', 'Volunteer');
                })
                    ->whereHas('volunteer', function ($volunteerQuery) use ($admin) {
                        $volunteerQuery->where('chapter_id', $admin->chapter_id);
                    });

                // Include all inactive donors (no chapter filtering)
                $query->orWhereHas('roles', function ($roleQuery) {
                    $roleQuery->where('role_name', 'Donor');
                });
            });

        // Apply role filter if not 'all'
        if ($filter !== 'all') {
            $query->whereHas('roles', function ($roleQuery) use ($filter) {
                $roleQuery->where('role_name', $filter);
            });
        }

        // Fetch inactive accounts
        $inactiveAccounts = $query->get();

        return view('admin.verify_account', compact('inactiveAccounts', 'filter'));
    }

    public function viewDetails($id)
    {
        $user = UserAccount::with(['roles', 'location'])->findOrFail($id);
        $details = null;
        $role = $user->role_name;
        $appointmentExists = false;

        if ($role === 'Donor') {
            $details = $user->donor;
        } elseif ($role === 'Volunteer') {
            $details = $user->volunteer()->with('chapter')->first();
            $appointmentExists = Appointment::where('volunteer_id', $details->id)->exists();
        }

        return view('admin.view_details', compact('user', 'details', 'role', 'appointmentExists'));
    }

    public function processVerification(Request $request, $id)
    {
        $user = UserAccount::findOrFail($id);
        $roleName = $user->roles->first()->role_name;
        $contact = $user->donor ? $user->donor->contact : $user->volunteer->contact;
        $name = $user->donor ? $user->donor->donor_name : $user->volunteer->volunteer_name;

        if ($request->action === 'verify') {
            $user->is_verified = true;
            $user->save();

            // Send verification email
            Mail::to($user->email)->send(new AccountVerifiedMail($user->username, $roleName));

            // Send verification SMS
            $message = "Hello {$name}, your {$roleName} account has been activated! "
                . "You can now login using your credentials. Thank you!";
            SmsHelper::sendSmsNotification($contact, $message);

            return redirect()->route('verify_account')->with('success', 'Account Activated Successfully.');
        } elseif ($request->action === 'not_verify') {
            // Send rejection email
            Mail::to($user->email)->send(new AccountRejectedMail());

            // Send rejection SMS
            $message = "Hello {$name}, we regret to inform you that your {$roleName} "
                . "account application was not approved. Thank you for your interest.";
            SmsHelper::sendSmsNotification($contact, $message);

            $user->delete();
            return redirect()->route('verify_account')->with('error', 'Account rejected and deleted.');
        }
    }

    public function create_appointment(Request $request, $id)
    {
        $request->validate([
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
        ]);

        $volunteer = Volunteer::with('chapter', 'user')->findOrFail($id);

        // Create the appointment
        Appointment::create([
            'volunteer_id' => $volunteer->id,
            'appointment_date' => $request->appointment_date,
            'appointment_time' => $request->appointment_time,
        ]);

        // Send email notification
        Mail::to($volunteer->user->email)->send(new AppointmentMail(
            $volunteer->first_name,
            $volunteer->last_name,
            $request->appointment_date,
            $request->appointment_time,
            $volunteer->chapter->chapter_name
        ));

        // **Send SMS notification**
        if (!empty($volunteer->contact)) {
            $message = "Hello {$volunteer->first_name}, your appointment is confirmed for {$request->appointment_date} at {$request->appointment_time} at {$volunteer->chapter->chapter_name}. Please check your email for details.";
            SmsHelper::sendSmsNotification($volunteer->contact, $message);
        }

        // Redirect with a success message
        return redirect()->route('admin.appointments')->with('success', 'Appointment set successfully. Email and SMS sent.');
    }
}
