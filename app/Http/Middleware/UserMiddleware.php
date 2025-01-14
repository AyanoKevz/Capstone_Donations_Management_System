<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the user has the required role (if needed)
        if (Auth::user()->role_name !== $role) {
            switch (Auth::user()->role_name) {
                case 'Donor':
                    return redirect()->route('donor.home')
                        ->with('error', 'Unauthorized access.');
                case 'Volunteer':
                    return redirect()->route('volunteer.home')
                        ->with('error', 'Unauthorized access.');
                default:
                    Auth::logout();
                    return redirect()->route('home')
                        ->with('error', 'Invalid user role.')
                        ->withInput()
                        ->header('Location', route('home') . '#portals');
            }
        }

        view()->share('User', Auth::user());
        return $next($request);
    }
}
