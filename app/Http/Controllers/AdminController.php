<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Chapter;
use App\Models\UserAccount;
use App\Models\Donor;
use App\Models\Appointment;
use App\Models\Admin;
use App\Models\Volunteer;
use App\Models\News;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountUpdated;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    // ADMIN LOGIN
    public function showLoginForm()
    {
        // If the admin is already logged in, redirect to the dashboard
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.admin_login');
    }

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


    // ADMIN DASHBOARD
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // ADMIN CHAPTERS
    public function chapters()
    {
        $chapters = Chapter::all();
        return view('admin.chapters', compact('chapters'));
    }


    public function CreateChapter(Request $request)
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


    //ADMIN PRFOLIE
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

        $changes = [];

        if ($request->hasFile('profile_image')) {
            if ($admin->profile_image && Storage::disk('public')->exists($admin->profile_image)) {
                Storage::disk('public')->delete($admin->profile_image);
            }
            $imagePath = $request->file('profile_image')->store('admin_photos', 'public');
            if ($admin->profile_image !== $imagePath) {
                $changes[] = 'profile_image';
                $admin->profile_image = $imagePath;
            }
        }

        if ($admin->name !== $request->input('name')) {
            $changes[] = 'name';
            $admin->name = $request->input('name');
        }

        if ($admin->email !== $request->input('email')) {
            $changes[] = 'email';
            $admin->email = $request->input('email');
        }

        if (empty($changes)) {
            return back()->with('info', 'No changes were made to your profile.');
        }

        // Save changes
        $admin->save();

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updateAccount(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $request->validate([
            'username' => 'required',
            'password' => 'nullable|confirmed|min:8',
        ]);
        $existingAdmin = Admin::where('username', $request->input('username'))
            ->where('id', '!=', $id)
            ->first();

        if ($existingAdmin) {
            return back()->with('error', 'The username is already in use by another account.');
        }

        $changes = [];

        // Update username if it has changed
        if ($admin->username !== $request->input('username')) {
            $changes[] = 'username';
            $admin->username = $request->input('username');
        }

        // Update password if provided
        if ($request->filled('password')) {
            // Check if the current password matches
            if (!Hash::check($request->input('oldPassword'), $admin->password)) {
                return back()->with('error', 'Current password is incorrect.');
            }

            // Update the password
            $changes[] = 'password';
            $admin->password = Hash::make($request->input('password'));
        }

        if (empty($changes)) {
            return back()->with('info', 'No changes were made to your account.');
        }

        $admin->save();

        // Send email notification about the changes
        $details = [
            'changes' => $changes,
            'username' => $admin->username,
        ];
        Mail::to($admin->email)->send(new AccountUpdated($details));

        return back()->with('success', 'Account updated successfully.');
    }


    //All ADMIN
    public function adminList()
    {
        $admins = Admin::all();
        return view('admin.admin_list', compact('admins'));
    }


    public function deleteAdmin(Request $request)
    {
        $admin = Admin::find($request->id);

        if ($admin) {
            if ($admin->profile_image && Storage::disk('public')->exists($admin->profile_image)) {
                Storage::disk('public')->delete($admin->profile_image);
            }
            $admin->delete();
            return redirect()->back()->with('success', 'Admin deleted successfully.');
        }

        return redirect()->back()->with('error', 'Admin not found.');
    }

    public function CreateAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admin,email',
        ]);

        // Generate credentials
        $username = 'uniaid_admin' . rand(1000, 9999);
        $password = explode('@', $request->email)[0] . rand(1000, 9999);

        // Create admin
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $username,
            'password' => bcrypt($password),
            'profile_image' => 'admin_photos/no_profile.png',
        ]);

        // Email details
        $details = [
            'name' => $request->name,
            'username' => $username,
            'password' => $password,
            'logoPath' => public_path('assets/img/systemLogo.png'),
        ];

        // Send email
        Mail::send('emails.admin_credentials', $details, function ($message) use ($request) {
            $message->to($request->email)
                ->subject('Your UniAid Admin Account Credentials');
        });

        return redirect()->back()->with('success', 'Admin account created successfully, and credentials have been emailed.');
    }


    //Donor LIST
    public function allDonors(Request $request)
    {
        // Get the filter from the request (default is 'all')
        $filter = $request->input('account_type', 'all');

        // Fetch active donors based on the filter
        $activeDonors = UserAccount::with(['roles', 'donor'])
            ->whereHas('roles', function ($query) {
                $query->where('role_name', 'Donor');
            })
            ->where('is_verified', true)
            ->when($filter !== 'all', function ($query) use ($filter) {
                $query->where('account_type', $filter);
            })
            ->get();

        return view('admin.donor_list', compact('activeDonors', 'filter'));
    }


    public function deleteDonor($userId)
    {
        // Find the donor via user_id
        $donor = Donor::where('user_id', $userId)->firstOrFail();

        // Delete the donor's ID image if it exists
        if ($donor->id_image && Storage::disk('public')->exists($donor->id_image)) {
            Storage::disk('public')->delete($donor->id_image);
        }

        // Delete the donor's user photo if it exists
        if ($donor->user_photo && Storage::disk('public')->exists($donor->user_photo)) {
            Storage::disk('public')->delete($donor->user_photo);
        }

        $donor->delete();

        $user = UserAccount::find($userId);
        if ($user) {
            $user->delete();
        }

        return redirect()->route('admin.donorList')->with('success', 'Donor account deleted successfully!');
    }


    //VOLUNTEERS LIST
    public function allVolunteers()
    {
        // Fetch active volunteers (is_verified = true)
        $activeVolunteers = UserAccount::with(['roles', 'volunteer.chapter'])
            ->whereHas('roles', function ($query) {
                $query->where('role_name', 'Volunteer');
            })
            ->where('is_verified', true)
            ->get();

        return view('admin.volunteer_list', compact('activeVolunteers'));
    }

    public function deleteVolunteer($userId)
    {

        $volunteer = Volunteer::where('user_id', $userId)->firstOrFail();

        if (
            $volunteer->id_image && Storage::disk('public')->exists($volunteer->id_image)
        ) {
            Storage::disk('public')->delete($volunteer->id_image);
        }

        if ($volunteer->user_photo && Storage::disk('public')->exists($volunteer->user_photo)) {
            Storage::disk('public')->delete($volunteer->user_photo);
        }

        $volunteer->delete();
        $user = UserAccount::find($userId);
        if ($user) {
            $user->delete();
        }

        return redirect()->route('admin.volunteerList')->with('success', 'Volunteer account deleted successfully!');
    }


    //NEWS

    public function showNews()
    {
        $news = News::all();
        return view('admin.news', compact('news'));
    }

    public function deleteNews(Request $request)
    {
        $news = News::find($request->id);

        if ($news) {
            $news->delete();
            return redirect()->back()->with('success', 'News deleted successfully.');
        }

        return redirect()->back()->with('error', 'News not found.');
    }
}
