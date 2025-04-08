<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class VolunteerSeeder extends Seeder
{
    public function run()
    {
        // Define valid IDs
        $validIDs = [
            "Philippine Passport",
            "Driver's License",
            "SSS ID",
            "UMID",
            "PhilHealth ID",
            "Voter's ID",
            "PRC ID",
            "Postal ID",
            "TIN ID",
            "Barangay ID"
        ];

        // Define default image paths
        $defaultIdPath = public_path('assets/img/fake_id.jpg');
        $defaultPhotoPath = public_path('assets/img/no_profile.png');

        // Ensure files exist
        if (!file_exists($defaultIdPath) || !file_exists($defaultPhotoPath)) {
            throw new \Exception("Default image files not found. Make sure 'fake_id.jpg' and 'no_profile.png' exist in 'public/assets/img/'.");
        }

        // Get all chapters
        $chapters = DB::table('chapter')->get();

        // Define preferred services
        $prefServices = ['Collect Donations', 'Relief Operations', 'Health Welfare', 'Emergency Response', 'General'];

        // Create volunteer accounts
        $volunteers = [];
        foreach ($chapters as $chapter) {
            for ($i = 1; $i <= 3; $i++) { // Create 3 accounts per chapter
                $username = 'volunteer_' . Str::lower($chapter->chapter_name) . '_' . $i;

                // Insert user account
                $userId = DB::table('user_account')->insertGetId([
                    'username' => $username,
                    'email' => $username . '@example.com',
                    'password' => Hash::make('12345678'),
                    'account_type' => 'Individual',
                    'is_verified' => true,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                // Generate unique filenames for images
                $idFilename = 'id_images/' . Str::random(10) . '_fake_id.jpg';
                $photoFilename = 'user_photos/' . Str::random(10) . '_no_profile.png';

                // Store images in 'storage/app/public'
                Storage::disk('public')->put($idFilename, file_get_contents($defaultIdPath));
                Storage::disk('public')->put($photoFilename, file_get_contents($defaultPhotoPath));

                // Build volunteer data
                $volunteers[] = [
                    'user_id' => $userId,
                    'first_name' => 'Volunteer',
                    'last_name' => 'Doe',
                    'contact' => '09' . str_pad(mt_rand(100000000, 999999999), 9, '0', STR_PAD_LEFT), // Generates valid PH number
                    'gender' => rand(0, 1) ? 'Male' : 'Female',
                    'id_type' => $validIDs[array_rand($validIDs)], // Random valid ID
                    'id_image' =>  $idFilename,
                    'user_photo' =>  $photoFilename,
                    'chapter_id' => $chapter->id,
                    'pref_services' => $prefServices[array_rand($prefServices)], // Random service
                    'availability' => ['Weekday', 'Weekend', 'Holiday', 'In time of Disasters'][array_rand(['Weekday', 'Weekend', 'Holiday', 'In time of Disasters'])],
                    'availability_time' => ['Morning', 'Afternoon', 'Night', 'On-Call', 'Whole-Day'][array_rand(['Morning', 'Afternoon', 'Night', 'On-Call', 'Whole-Day'])],
                    'created_at' => now(),
                    'updated_at' => now()
                ];

                // Add location for the volunteer
                DB::table('location')->insert([
                    'user_id' => $userId,
                    'region' => $chapter->region,
                    'province' => 'N/A', // Default value
                    'city_municipality' => $chapter->chapter_name,
                    'barangay' => 'Barangay 1', // Default value
                    'full_address' => $chapter->address,
                    'latitude' => $chapter->latitude,
                    'longitude' => $chapter->longitude,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }

        // Insert volunteer data
        DB::table('volunteer')->insert($volunteers);

        // Assign "Volunteer" role to users
        $volunteerRole = DB::table('roles')->where('role_name', 'Volunteer')->first();
        foreach (DB::table('user_account')->whereIn('id', array_column($volunteers, 'user_id'))->get() as $user) {
            DB::table('user_roles')->insert([
                'user_id' => $user->id,
                'role_id' => $volunteerRole->id,
            ]);
        }
    }
}
