<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAccount;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate input
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt login
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $user = Auth::user();

            // Check if the account is verified
            if ($user->is_verified == 0) {
                Auth::logout();
                // Redirect with error message and ensure it redirects to #portals
                return redirect()->route('home')
                    ->with('error', 'Your account is not verified yet.')
                    ->withInput()
                    ->header('Location', route('home') . '#portals');
            }

            // Fetch the user's role (assuming one role per user)
            $role = $user->roles->first();  // Get the first role in the collection
            $role_name = $role ? $role->role_name : null; // Get the role name, if available

            // Redirect based on the user's role
            switch ($role_name) {
                case 'Donor':
                    return redirect()->route('donor.dashboard');
                case 'Donee':
                    return redirect()->route('donee.dashboard');
                case 'Volunteer':
                    return redirect()->route('volunteer.dashboard');
                case 'Admin':
                    return redirect()->route('admin.dashboard');
                default:
                    Auth::logout();
                    // Redirect with error message if role is invalid
                    return redirect()->route('home')
                        ->with('error', 'Invalid user role.')
                        ->withInput()
                        ->header('Location', route('home') . '#portals');
            }
        }

        // If login fails
        return redirect()->route('home')
            ->with('error', 'Invalid credentials. Please try again.')
            ->withInput()
            ->header('Location', route('home') . '#portals');
    }
}
