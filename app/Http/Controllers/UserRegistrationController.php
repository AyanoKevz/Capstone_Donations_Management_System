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


    public function registerDonee(Request $request)
    {
        $validated = $this->validateRegistration($request, 'Donee');

        // Create user account
        $userAccount = UserAccount::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'account_type' => $validated['accountType'],
        ]);

        // Attach role
        $role = Role::where('role_name', 'Donee')->first();
        $userAccount->roles()->attach($role);

        // Create location and associate with user
        Location::create(array_merge($this->mapLocationData($request), ['user_id' => $userAccount->id]));

        // Create donee record
        Donee::create(array_merge($this->mapPersonalData($request), [
            'user_id' => $userAccount->id,
        ]));


        Mail::to($userAccount->email)->send(new RegistrationEmail($userAccount->username, 'Donee'));

        return redirect()->route('register')->with('success', 'Donee registration successful.');
    }


    public function registerVolunteer(Request $request)
    {
        $validated = $this->validateRegistration($request, 'Volunteer');

        // Create user account
        $userAccount = UserAccount::create([
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'account_type' => $validated['accountType'],
        ]);

        $role = Role::where('role_name', 'Volunteer')->first();
        $userAccount->roles()->attach($role);
        Location::create(array_merge($this->mapLocationData($request), ['user_id' => $userAccount->id]));
        Volunteer::create(array_merge($this->mapPersonalData($request), [
            'user_id' => $userAccount->id,
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

    private function validateRegistration(Request $request, string $role)
    {
        // Determine the table based on the role
        $table = match ($role) {
            'Donor' => 'donor',
            'Donee' => 'donee',
            'Volunteer' => 'volunteer',
            default => throw new \InvalidArgumentException('Invalid role'),
        };

        return $request->validate([
            'username' => 'string|max:100|unique:user_account',
            'email' => 'email|max:100|unique:user_account',
            'password' => 'confirmed|min:8',
            'accountType' => 'string|in:Individual,Organization',
            'fname' => 'string|max:100',
            'lname' => 'string|max:100',
            'contact_number' => [
                'string',
                'max:15',
                Rule::unique($table, 'contact')
            ],
            'bday' => 'date',
            'gender' => 'string',
            'region' => 'string',
            'province' => 'string',
            'city' => 'string',
            'barangay' => 'string',
            'full_address' => 'string|max:255',
            'id_type' => 'string',
            'id_image' => 'file|mimes:jpeg,jpg,png|max:5120',
            'user_photo' => 'file|mimes:jpeg,jpg,png|max:5120',
        ]);


        if ($role === 'Volunteer') {
            $rules = array_merge($rules, [
                'pref_services' => 'string|in:collect_donations,distribute_donations,provide_support',
                'availability' => 'string|in:weekday,weekend,holiday,disasters',
                'availability_time' => 'string|in:morning,afternoon,night,on_call,whole_day',
                'educ_prof' => 'string|in:grade_school_graduate,high_school_graduate,vocational_short_courses_graduate,college_graduate,masters_degree_holder,doctorate_degree_holder',
                'studying' => 'string|in:Yes,No',
                'employed' => 'string|in:Yes,No',
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
