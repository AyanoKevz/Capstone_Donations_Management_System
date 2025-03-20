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
                    ->with('error', 'Your account is not active. An email will be sent to you once it is active.')
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

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('home')
            ->with('success', 'You have been logged out successfully.')
            ->header('Location', route('home') . '#portals');
    }

    public function mobileLoginForm()
    {
        return view('homepage.mobile-login');
    }

    public function SubmitMobileLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if account is verified
            if (!$user->is_verified) {
                Auth::logout();
                return redirect()->route('mobile-login')->with('error', 'Your account is not active. An email will be sent to you once it is active. ');
            }

            switch ($user->role_name) {
                case 'Donor':
                    return redirect()->route('donor.home');
                case 'Volunteer':
                    return redirect()->route('volunteer.home');
                default:
                    Auth::logout();
                    return redirect()->route('mobile-login')->with('error', 'Invalid user role.');
            }
        }

        // Authentication failed
        return redirect()->route('mobile-login')->with('error', 'Invalid username or password.');
    }
}
