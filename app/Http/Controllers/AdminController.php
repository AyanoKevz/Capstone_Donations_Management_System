<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        // If the admin is already logged in, redirect to the dashboard
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        // Prevent caching of the login page
        return response()->view('admin.admin_login')->withHeaders([
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ]);
    }


    // login function
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        // Attempt to authenticate using custom guard
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Invalid username or password']);
    }

    // Admin dashboard
    public function dashboard()
    {
        return response()->view('admin.dashboard')->header('Cache-Control', 'no-store, no-cache, must-revalidate, proxy-revalidate')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function logout()
    {

        Auth::guard('admin')->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
