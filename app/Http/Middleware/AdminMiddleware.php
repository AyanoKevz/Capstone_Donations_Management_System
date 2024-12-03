<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if user is authenticated via the admin guard
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }

        // Redirect if not authenticated as admin
        return redirect()->route('admin.login')->withErrors(['Unauthorized access']);
    }
}
