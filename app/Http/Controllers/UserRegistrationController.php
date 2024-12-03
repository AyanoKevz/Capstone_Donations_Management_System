<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\UserAccount;
use App\Models\Donor;
use App\Models\Donee;
use App\Models\Volunteer;
use App\Models\Role;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function showDoneeForm()
    {
        return view('homepage.donee_r');
    }

    public function showVolunteerForm()
    {
        return view('homepage.volunteer_r');
    }

    public function registerDonor(Request $request)
    {
        $validated = $this->validateRegistration($request);

        $location = Location::create($this->mapLocationData($request));

        $userAccount = UserAccount::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'account_type' => $validated['accountType'],
        ]);

        $role = Role::where('role_name', 'Donor')->first();
        $userAccount->roles()->attach($role);

        Donor::create(array_merge($this->mapPersonalData($request), [
            'user_id' => $userAccount->id,
            'location_id' => $location->id,
        ]));

        Mail::to($userAccount->email)->send(new RegistrationEmail($userAccount->username, 'Donor'));
        return redirect()->route('register')->with('success', 'Donor registration successful.');
    }

    public function registerDonee(Request $request)
    {
        $validated = $this->validateRegistration($request);

        $location = Location::create($this->mapLocationData($request));

        $userAccount = UserAccount::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'account_type' => $validated['accountType'],
        ]);

        $role = Role::where('role_name', 'Donee')->first();
        $userAccount->roles()->attach($role);

        Donee::create(array_merge($this->mapPersonalData($request), [
            'user_id' => $userAccount->id,
            'location_id' => $location->id,
        ]));

        Mail::to($userAccount->email)->send(new RegistrationEmail($userAccount->username, 'Donee'));
        return redirect()->route('register')->with('success', 'Donee registration successful.');
    }

    public function registerVolunteer(Request $request)
    {
        $validated = $this->validateVolunteerRegistration($request);

        $location = Location::create($this->mapLocationData($request));

        $userAccount = UserAccount::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'account_type' => $validated['accountType'],
        ]);

        $role = Role::where('role_name', 'Volunteer')->first();
        $userAccount->roles()->attach($role);

        Volunteer::create(array_merge($this->mapPersonalData($request), [
            'user_id' => $userAccount->id,
            'location_id' => $location->id,
            'pref_services' => $validated['pref_services'],
            'availability' => $validated['availability'],
            'availability_time' => $validated['availability_time'],
            'educ_prof' => $validated['educ_prof'],
            'studying' => $validated['studying'],
            'employed' => $validated['employed'],
        ]));

        Mail::to($userAccount->email)->send(new RegistrationEmail($userAccount->username, 'Volunteer'));
        return redirect()->route('register')->with('success', 'Volunteer registration successful.');
    }


    private function validateRegistration(Request $request)
    {
        return $request->validate([
            'username' => 'required|string|max:100|unique:user_account',
            'email' => 'required|email|max:100|unique:user_account',
            'password' => 'required|confirmed|min:8',
            'accountType' => 'required|string',
            'fname' => 'required|string|max:100',
            'lname' => 'required|string|max:100',
            'contact_number' => 'required|string|max:15|',
            'bday' => 'required|date',
            'gender' => 'required|string',
            'region' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'barangay' => 'required|string',
            'full_address' => 'required|string|max:255',
            'id_type' => 'required|string',
            'id_image' => 'required|file|mimes:jpeg,jpg,png|max:5120',
            'user_photo' => 'required|file|mimes:jpeg,jpg,png|max:5120',
        ]);
    }

    private function validateVolunteerRegistration(Request $request)
    {
        return $request->validate(array_merge($this->validateRegistration($request), [
            'pref_services' => 'required|string|in:collect_donations,distribute_donations,provide_support',
            'availability' => 'required|string|in:weekday,weekend,holiday,disasters',
            'availability_time' => 'required|string|in:morning,afternoon,night,on_call,whole_day',
            'educ_prof' => 'required|string|in:grade_school_graduate,high_school_graduate,vocational_short_courses_graduate,college_graduate,masters_degree_holder,doctorate_degree_holder',
            'studying' => 'required|string|in:Yes,No',
            'employed' => 'required|string|in:Yes,No',
        ]));
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
            'middle_name' => $request->mname,
            'last_name' => $request->lname,
            'contact' => $request->contact_number,
            'birthday' => $request->bday,
            'gender' => $request->gender,
            'id_type' => $request->id_type,
            'id_image' => $request->file('id_image')->store('id_images', 'public'),
            'user_photo' => $request->file('user_photo')->store('user_photos', 'public'),
        ];
    }
}
