<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\AccountVerifiedMail;
use App\Mail\AccountRejectedMail;
use App\Mail\AppointmentMail;

use App\Models\UserAccount;
use App\Models\Appointment;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class VerifyAcct extends Controller
{
    public function showInactiveAccounts(Request $request)
    {
        // Retrieve the filter value from the query parameter
        $filter = $request->query('role_name', 'all');
        $query = UserAccount::with('roles')->where('is_verified', false);

        if ($filter !== 'all') {
            $query->whereHas('roles', function ($roleQuery) use ($filter) {
                $roleQuery->where('role_name', $filter);
            });
        }

        $inactiveAccounts = $query->get();
        return view('admin.verify_account', compact('inactiveAccounts', 'filter'));
    }

    public function viewDetails($id)
    {
        $user = UserAccount::with(['roles', 'location'])->findOrFail($id);
        $details = null;
        $role = $user->role_name;

        if ($role === 'Donor') {
            $details = $user->donor;
        } elseif ($role === 'Volunteer') {
            $details = $user->volunteer()->with('chapter')->first();
            $appointmentExists = Appointment::where('volunteer_id', $user->id)->exists();
        }

        return view('admin.view_details', compact('user', 'details', 'role', 'appointmentExists'));
    }


    public function processVerification(Request $request, $id)
    {
        $user = UserAccount::findOrFail($id);

        if ($request->action === 'verify') {
            $user->is_verified = true;
            $user->save();

            Mail::to($user->email)->send(new AccountVerifiedMail($user->username, $user->roles->first()->role_name));

            return redirect()->route('verify_account')->with('success', 'Account Activated Successfully.');
        } elseif ($request->action === 'not_verify') {

            Mail::to($user->email)->send(new AccountRejectedMail());
            $user->delete();

            return redirect()->route('verify_account')->with('error', 'Account Inactive and deleted.');
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

        // Redirect with a success message
        return redirect()->route('admin.appointments')->with('success', 'Appointment set successfully and email sent.');
    }
}
