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
            return redirect()->route('home')
                ->with('error', 'Unauthorized access.')
                ->withInput()
                ->header('Location', route('home') . '#portals');
        }

        return $next($request);
    }
}
