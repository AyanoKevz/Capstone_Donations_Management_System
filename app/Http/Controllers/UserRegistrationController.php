<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\UserAccount;
use App\Models\Chapter;
use App\Models\Donor;
use App\Models\Volunteer;
use App\Models\Role;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserRegistrationController extends Controller
{
    public function showRegistrationType()
    {
        return view('homepage.register');
    }

    public function showDonorForm()
    {
        return view('homepage.donor_r');
    }

    public function showVolunteerForm()
    {
        $chapters = Chapter::all();
        return view('homepage.volunteer_r', compact('chapters'));
    }

    public function registerDonor(Request $request)
    {
        $validated = $this->validateRegistration($request, 'Donor');

        $userAccount = UserAccount::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'account_type' => $validated['accountType'],
        ]);

        $role = Role::where('role_name', 'Donor')->first();
        $userAccount->roles()->attach($role);

        Location::create(array_merge($this->mapLocationData($request), ['user_id' => $userAccount->id]));

        Donor::create(array_merge($this->mapPersonalData($request), [
            'user_id' => $userAccount->id,
        ]));

        Mail::to($userAccount->email)->send(new RegistrationEmail($userAccount->username, 'Donor'));

        return redirect()->route('register')->with('success', 'Donor registration successful.');
    }

    public function registerVolunteer(Request $request)
    {
        $validated = $this->validateRegistration($request, 'Volunteer');

        $userAccount = UserAccount::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'account_type' => 'Individual',
        ]);

        $role = Role::where('role_name', 'Volunteer')->first();
        $userAccount->roles()->attach($role);

        Location::create(array_merge($this->mapLocationData($request), ['user_id' => $userAccount->id]));

        Volunteer::create(array_merge($this->mapPersonalData($request), [
            'user_id' => $userAccount->id,
            'pref_services' => $validated['pref_services'],
            'availability' => $validated['availability'],
            'availability_time' => $validated['availability_time'],
            'chapter_id' => $validated['chapter'], // Save the chapter ID
        ]));


        Mail::to($userAccount->email)->send(new RegistrationEmail($userAccount->username, 'Volunteer'));

        return redirect()->route('register')->with('success', 'Volunteer registration successful.');
    }

    private function validateRegistration(Request $request, string $role)
    {
        $rules = [
            'username' => 'required|string|max:100|unique:user_account',
            'email' => 'required|email|max:100|unique:user_account',
            'password' => 'required|confirmed|min:8',
            'accountType' => 'required|string|in:Individual,Organization',
            'fname' => 'required|string|max:100',
            'lname' => 'nullable|string|max:100',
            'gender' => 'nullable|string',
            'contact_number' => [
                'required',
                'string',
                'max:15',
                Rule::unique($role === 'Donor' ? 'donor' : 'volunteer', 'contact'),
            ],
            'region' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'barangay' => 'required|string',
            'full_address' => 'required|string|max:255',
            'id_type' => 'required|string',
            'id_image' => 'required|file|mimes:jpeg,jpg,png|max:5120',
            'user_photo' => 'required|file|mimes:jpeg,jpg,png|max:5120',
        ];

        if ($role === 'Volunteer') {
            $rules = array_merge($rules, [
                'pref_services' => 'required|string|in:Emergency Response,Health Welfare,Relief Operations,Collect Donations,General',
                'availability' => 'required|string|in:Weekday,Weekend,Holiday,In time of Disasters',
                'availability_time' => 'required|string|in:Morning,Afternoon,Night,On-Call,Whole-Day',
                'chapter' => 'required|exists:chapter,id',
            ]);
        }

        return $request->validate($rules);
    }

    private function mapLocationData(Request $request)
    {
        return [
            'region' => $request->region_name,
            'province' => $request->province_name,
            'city_municipality' => $request->city_name,
            'barangay' => $request->barangay_name,
            'full_address' => $request->full_address,
        ];
    }

    private function mapPersonalData(Request $request)
    {
        return [
            'first_name' => $request->fname,
            'last_name' => $request->lname,
            'contact' => $request->contact_number,
            'gender' => $request->gender,
            'id_type' => $request->id_type,
            'id_image' => $request->file('id_image')->store('id_images', 'public'),
            'user_photo' => $request->file('user_photo')->store('user_photos', 'public'),
        ];
    }
}
