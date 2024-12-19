<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect(url(route('home') . '#portals'))
                ->with('error', 'You need to log in to access this page.');
        }

        $userRole = Auth::user()->role_name;

        // Check if the user has the correct role
        if ($userRole !== $role) {
            return redirect(url(route('home') . '#portals'))
                ->with('error', 'Unauthorized access.');
        }

        return $next($request);
    }
}
