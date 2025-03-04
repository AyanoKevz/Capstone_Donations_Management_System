<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DonorSeeder extends Seeder
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

        // Create 6 donor accounts
        $users = [
            [
                'username' => 'donor123',
                'email' => 'donor1@example.com',
                'password' => Hash::make('12345678'),
                'account_type' => 'Individual',
                'is_verified' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'username' => 'donor234',
                'email' => 'donor2@example.com',
                'password' => Hash::make('12345678'),
                'account_type' => 'Individual',
                'is_verified' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'username' => 'donor345',
                'email' => 'donor3@example.com',
                'password' => Hash::make('12345678'),
                'account_type' => 'Individual',
                'is_verified' => false,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'username' => 'donor456',
                'email' => 'donor4@example.com',
                'password' => Hash::make('12345678'),
                'account_type' => 'Organization',
                'is_verified' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'username' => 'donor567',
                'email' => 'donor5@example.com',
                'password' => Hash::make('12345678'),
                'account_type' => 'Organization',
                'is_verified' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'username' => 'donor678',
                'email' => 'donor6@example.com',
                'password' => Hash::make('12345678'),
                'account_type' => 'Organization',
                'is_verified' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        // Insert user accounts
        DB::table('user_account')->insert($users);

        // Assign "Donor" role to users and add locations
        $donorRole = DB::table('roles')->where('role_name', 'Donor')->first();
        $donors = [];
        foreach (DB::table('user_account')->get() as $user) {
            // Assign role
            DB::table('user_roles')->insert([
                'user_id' => $user->id,
                'role_id' => $donorRole->id,
            ]);

            // Add location
            DB::table('location')->insert([
                'user_id' => $user->id,
                'region' => 'NCR',
                'province' => 'N/A',
                'city_municipality' => 'Caloocan',
                'barangay' => 'Barangay ' . mt_rand(1, 195),
                'full_address' => 'Full Address  #' . mt_rand(1, 100),
                'latitude' => null,
                'longitude' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Generate unique filenames for images
            $idFilename = 'id_images/' . Str::random(10) . '_fake_id.jpg';
            $photoFilename = 'user_photos/' . Str::random(10) . '_no_profile.png';

            // Store images in 'storage/app/public'
            Storage::disk('public')->put($idFilename, file_get_contents($defaultIdPath));
            Storage::disk('public')->put($photoFilename, file_get_contents($defaultPhotoPath));

            // Build donor data
            $donors[] = [
                'user_id' => $user->id,
                'first_name' => ucfirst($user->username), // Capitalized from username
                'last_name' => 'Doe',
                'contact' => '09' . str_pad(mt_rand(100000000, 999999999), 9, '0', STR_PAD_LEFT), // Generates valid PH number
                'gender' => rand(0, 1) ? 'Male' : 'Female',
                'id_type' => $validIDs[array_rand($validIDs)], // Random valid ID
                'id_image' =>  $idFilename,
                'user_photo' => $photoFilename,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Insert donor data
        DB::table('donor')->insert($donors);
    }
}
