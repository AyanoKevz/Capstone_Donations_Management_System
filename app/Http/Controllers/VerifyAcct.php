<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\AccountVerifiedMail;
use App\Mail\AccountRejectedMail;
use Illuminate\Support\Facades\Log;
use App\Models\UserAccount;
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
        // Retrieve the user along with roles and location
        $user = UserAccount::with(['roles', 'location'])->findOrFail($id);
    
        $details = null;
    
        // Check the first role assigned to the user
        $role = $user->roles->first()->role_name ?? null;
    
        if ($role === 'Donor') {
            $details = $user->donor;
        } elseif ($role === 'Donee') {
            $details = $user->donee;
        } elseif ($role === 'Volunteer') {
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

            // Send verification email with embedded logo
            Mail::to($user->email)->send(new AccountVerifiedMail($user->username, $user->roles->first()->role_name));

            return redirect()->route('verify_account')->with('success', 'Account verified successfully.');
        } elseif ($request->action === 'not_verify') {
            // Send account rejection email
            Mail::to($user->email)->send(new AccountRejectedMail());

            // Delete the user account
            $user->delete();

            return redirect()->route('verify_account')->with('error', 'Account rejected and deleted.');
        }
    }
}
