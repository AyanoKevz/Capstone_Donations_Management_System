<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\AccountVerifiedMail;
use App\Mail\AccountRejectedMail;
use App\Models\UserAccount;
use Illuminate\Http\Request;

class VerifyAcct extends Controller
{
    public function showInactiveAccounts()
    {
        // Retrieve only inactive Volunteer accounts
        $inactiveAccounts = UserAccount::with('roles')
            ->whereHas('roles', function ($roleQuery) {
                $roleQuery->where('role_name', 'Volunteer');
            })
            ->where('is_verified', false)
            ->get();

        return view('admin.verify_account', compact('inactiveAccounts'));
    }

    public function viewDetails($id)
    {
        // Retrieve the user along with their roles and location
        $user = UserAccount::with(['roles', 'location'])->findOrFail($id);

        $details = null;

        // Check if the user's role is Volunteer
        $role = $user->roles->first()->role_name ?? null;
        if ($role === 'Volunteer') {
            $details = $user->volunteer;
        }

        return view('admin.view_details', compact('user', 'details', 'role'));
    }

    public function processVerification(Request $request, $id)
    {
        $user = UserAccount::findOrFail($id);

        if ($request->action === 'verify') {
            $user->is_verified = true;
            $user->save();

            // Send verification email
            Mail::to($user->email)->send(new AccountVerifiedMail($user->username, $user->roles->first()->role_name));

            return redirect()->route('verify_account')->with('success', 'Account Verified Successfully.');
        } elseif ($request->action === 'not_verify') {
            // Send account rejection email
            Mail::to($user->email)->send(new AccountRejectedMail());

            // Delete the user account
            $user->delete();

            return redirect()->route('verify_account')->with('error', 'Account Not Verified and Deleted.');
        }
    }
}
