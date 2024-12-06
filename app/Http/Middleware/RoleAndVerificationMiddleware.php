<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleAndVerificationMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            // If user is not logged in, redirect to home and scroll to #portals with an error
            return redirect()->route('home')
                ->withErrors('error', 'You must log in to access this page.')
                ->withInput()
                ->header('Location', route('home') . '#portals');
        }

        $user = Auth::user();

        // Check if user is verified
        if ($user->is_verified == 0) {
            // If account is not verified, log the user out and redirect with an error
            Auth::logout();
            return redirect()->route('home')
                ->withErrors('error', 'Your account is not verified yet.')
                ->withInput()
                ->header('Location', route('home') . '#portals');
        }

        // Check if user role matches the required role
        if ($user->role !== $role) {
            // If user role does not match, redirect with an error
            return redirect()->route('home')
                ->withErrors('error', 'Invalid user role.')
                ->withInput()
                ->header('Location', route('home') . '#portals');
        }

        // Proceed to the next middleware or controller if everything is correct
        return $next($request);
    }
}
