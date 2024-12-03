<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PreventCache
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Add cache-control headers to prevent caching
        $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, proxy-revalidate');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');

        return $response;
    }
}
