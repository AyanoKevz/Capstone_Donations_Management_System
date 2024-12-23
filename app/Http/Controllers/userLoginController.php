<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class userLoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if account is verified
            if (!$user->is_verified) {
                Auth::logout();
                return redirect()->route('home')
                    ->with('error', 'You account is not verified yet.')
                    ->withInput()
                    ->header('Location', route('home') . '#portals');
            }


            switch ($user->role_name) {
                case 'Donor':
                    return redirect()->route('donor.home');
                case 'Volunteer':
                    return redirect()->route('volunteer.home');
                default:
                    Auth::logout();
                    return redirect()->route('home')
                        ->with('error', 'Invalid user role.')
                        ->withInput()
                        ->header('Location', route('home') . '#portals');
            }
        }

        // Authentication failed
        return redirect()->route('home')
            ->with('error', 'Invalid username or password.')
            ->withInput()
            ->header('Location', route('home') . '#portals');
    }
}
