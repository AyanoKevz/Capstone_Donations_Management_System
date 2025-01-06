<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Chapter;
use App\Models\Appointment;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        // If the admin is already logged in, redirect to the dashboard
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.admin_login');
    }


    // login function
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['username' => 'Invalid username or password']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'You have been logged out successfully.');
    }


    // Admin dashboard
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Admin chapters
    public function chapters()
    {
        $chapters = Chapter::all();
        return view('admin.chapters', compact('chapters'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'chapter_name' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'region' => 'required|string|max:100',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        Chapter::create([
            'chapter_name' => $request->chapter_name,
            'address' => $request->address,
            'region' => $request->region,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->route('admin.chapters')->with('success', 'Chapter created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'chapter_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $chapter = Chapter::findOrFail($id);

        $chapter->update([
            'chapter_name' => $request->chapter_name,
            'address' => $request->address,
            'region' => $request->region,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return redirect()->back()->with('success', 'Chapter updated successfully!');
    }

    public function destroy($id)
    {

        $chapter = Chapter::findOrFail($id);

        $chapter->delete();
        return redirect()->back()->with('success', 'Chapter deleted successfully!');
    }

    public function showAppointments()
    {
        $appointments = Appointment::with(['volunteer.user', 'volunteer.chapter'])->get();

        return view('admin.appointments', compact('appointments'));
    }

    public function delete_appointment(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->back()->with('success', 'Appointment deleted successfully.');
    }


    // Admin Profile
    public function admin_profile()
    {
        return view('admin.admin_profile');
    }


    public function updateProfile(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'email' => 'required|email|unique:admin,email,' . $id,
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('profile_images', 'public');
            $admin->profile_image = $imagePath;
        }

        $admin->name = $request->input('name');
        $admin->email = $request->input('email');
        $admin->save();

        return back()->with('success', 'Profile updated successfully.');
    }



    public function updateAccount(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'username' => 'required|unique:admin,username,' . $id,
            'oldPassword' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        if (!Hash::check($request->input('oldPassword'), $admin->password)) {
            return back()->withErrors(['oldPassword' => 'Current password is incorrect.']);
        }

        $admin->username = $request->input('username');
        $admin->password = Hash::make($request->input('password'));
        $admin->save();

        return back()->with('success', 'Account updated successfully.');
    }
}
