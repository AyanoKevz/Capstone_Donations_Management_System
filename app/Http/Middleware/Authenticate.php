<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('home')
                ->with('error', 'Unauthorized access. You need to log in to access this page.')
                ->withInput()
                ->header('Location', route('home') . '#portals');
        }

        return $next($request);
    }
}
