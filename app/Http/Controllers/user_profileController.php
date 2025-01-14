<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use App\Models\Chapter;
use App\Models\UserAccount;
use App\Models\Donor;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Hash;
use App\Mail\AccountUpdated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class user_profileController extends Controller
{




    public function DonorProfile()
    {
        return view('users.donor.donor_profile');
    }

    public function VolunteerProfile()
    {
        $chapters = Chapter::all();
        return view('users.volunteer.volunteer_profile', compact('chapters'));
    }


    // Update Donor Profile
    public function updateDonorProfile(Request $request, $id)
    {
        $user = UserAccount::findOrFail($id);
        $donor = $user->donor;

        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('user_account', 'email')->ignore($id),
            ],
            'contact' => [
                'required',
                Rule::unique('donor', 'contact')->where(function ($query) use ($id) {
                    return $query->where('user_id', '!=', $id);
                }),
            ],
            'user_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'email.unique' => 'The email is already taken by another account.',
            'contact.unique' => 'The contact number is already registered in the donor.',
        ]);

        // Track changes
        $changes = false;

        if ($user->email !== $request->email) {
            $user->email = $request->email;
            $changes = true;
        }

        if ($donor->first_name !== $request->fname) {
            $donor->first_name = $request->fname;
            $changes = true;
        }

        if ($donor->last_name !== $request->lname) {
            $donor->last_name = $request->lname;
            $changes = true;
        }

        if ($donor->contact !== $request->contact) {
            $donor->contact = $request->contact;
            $changes = true;
        }

        $location = $user->location;
        $locationData = [
            'region' => $request->region_name ?? $location->region,
            'province' => $request->province_name ?? $location->province,
            'city_municipality' => $request->city_name ?? $location->city_municipality,
            'barangay' => $request->barangay_name ?? $location->barangay,
            'full_address' => $request->full_address ?? $location->full_address,
            'latitude' => $request->latitude ?? $location->latitude,
            'longitude' => $request->longitude ?? $location->longitude,
        ];

        if ($location) {
            foreach ($locationData as $key => $value) {
                if ($location->$key !== $value) {
                    $location->$key = $value;
                    $changes = true;
                }
            }
            $location->save();
        } else {
            $user->location()->create($locationData);
            $changes = true;
        }

        // Handle user photo upload
        if ($request->hasFile('user_photo')) {
            if ($donor->user_photo && Storage::disk('public')->exists($donor->user_photo)) {
                Storage::disk('public')->delete($donor->user_photo);
            }

            $path = $request->file('user_photo')->store('user_photos', 'public');
            $donor->user_photo = $path;
            $changes = true;
        }

        if ($changes) {
            $user->save();
            $donor->save();
            return redirect()->back()->with('success', 'Donor profile updated successfully.');
        }

        return redirect()->back()->with('info', 'No changes were made to the donor profile.');
    }

    // Update Volunteer Profile
    public function updateVolunteerProfile(Request $request, $id)
    {
        $user = UserAccount::findOrFail($id);
        $volunteer = $user->volunteer;

        $request->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('user_account', 'email')->ignore($id),
            ],
            'contact' => [
                'required',
                Rule::unique('volunteer', 'contact')->where(function ($query) use ($id) {
                    return $query->where('user_id', '!=', $id);
                }),
            ],
            'user_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'email.unique' => 'The email is already taken by another account.',
            'contact.unique' => 'The contact number is already registered in the volunteer.',
        ]);

        // Track changes
        $changes = false;

        if ($user->email !== $request->email) {
            $user->email = $request->email;
            $changes = true;
        }

        if ($volunteer->first_name !== $request->fname) {
            $volunteer->first_name = $request->fname;
            $changes = true;
        }

        if ($volunteer->last_name !== $request->lname) {
            $volunteer->last_name = $request->lname;
            $changes = true;
        }

        if ($volunteer->contact !== $request->contact) {
            $volunteer->contact = $request->contact;
            $changes = true;
        }

        $location = $user->location;
        $locationData = [
            'region' => $request->region_name ?? $location->region,
            'province' => $request->province_name ?? $location->province,
            'city_municipality' => $request->city_name ?? $location->city_municipality,
            'barangay' => $request->barangay_name ?? $location->barangay,
            'full_address' => $request->full_address ?? $location->full_address,
            'latitude' => $request->latitude ?? $location->latitude,
            'longitude' => $request->longitude ?? $location->longitude,
        ];

        if ($location) {
            foreach ($locationData as $key => $value) {
                if ($location->$key !== $value) {
                    $location->$key = $value;
                    $changes = true;
                }
            }
            $location->save();
        } else {
            $user->location()->create($locationData);
            $changes = true;
        }

        // Handle user photo upload
        if ($request->hasFile('user_photo')) {
            if ($volunteer->user_photo && Storage::disk('public')->exists($volunteer->user_photo)) {
                Storage::disk('public')->delete($volunteer->user_photo);
            }

            $path = $request->file('user_photo')->store('user_photos', 'public');
            $volunteer->user_photo = $path;
            $changes = true;
        }

        // Update other volunteer-specific fields
        if ($volunteer->chapter_id !== $request->chapter) {
            $volunteer->chapter_id = $request->chapter;
            $changes = true;
        }

        if ($volunteer->pref_services !== $request->pref_services) {
            $volunteer->pref_services = $request->pref_services;
            $changes = true;
        }

        if ($volunteer->availability !== $request->availability) {
            $volunteer->availability = $request->availability;
            $changes = true;
        }

        if ($volunteer->availability_time !== $request->availability_time) {
            $volunteer->availability_time = $request->availability_time;
            $changes = true;
        }

        if ($changes) {
            $user->save();
            $volunteer->save();
            return redirect()->back()->with('success', 'Volunteer profile updated successfully.');
        }

        return redirect()->back()->with('info', 'No changes were made to the volunteer profile.');
    }



    public function updateUserAccount(Request $request, $id)
    {
        $user = UserAccount::findOrFail($id);

        $request->validate([
            'username' => 'required',
            'password' => 'nullable|confirmed|min:8',
        ]);
        $existingUser = UserAccount::where('username', $request->input('username'))
            ->where('id', '!=', $id)
            ->first();

        if ($existingUser) {
            return back()->with('error', 'The username is already in use by another account.');
        }

        $changes = [];

        // Update username if it has changed
        if ($user->username !== $request->input('username')) {
            $changes[] = 'username';
            $user->username = $request->input('username');
        }

        // Update password if provided
        if ($request->filled('password')) {
            // Check if the current password matches
            if (!Hash::check($request->input('oldPassword'), $user->password)) {
                return back()->with('error', 'Current password is incorrect.');
            }

            // Update the password
            $changes[] = 'password';
            $user->password = Hash::make($request->input('password'));
        }

        if (empty($changes)) {
            return back()->with('info', 'No changes were made to your account.');
        }

        $user->save();

        // Send email notification about the changes
        $details = [
            'changes' => $changes,
            'username' => $user->username,
        ];
        Mail::to($user->email)->send(new AccountUpdated($details));

        return back()->with('success', 'Account updated successfully.');
    }
}
