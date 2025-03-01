<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonorSeeder extends Seeder
{
    public function run()
    {

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

        $donors = [];
        foreach (DB::table('user_account')->get() as $user) {
            $donors[] = [
                'user_id' => $user->id,
                'first_name' => ucfirst($user->username),
                'last_name' => 'Doe',
                'contact' => '09' . str_pad(mt_rand(100000000, 999999999), 9, '0', STR_PAD_LEFT),
                'gender' => rand(0, 1) ? 'Male' : 'Female',
                'id_type' => $validIDs[array_rand($validIDs)],
                'id_image' => 'id_images/fake_id.jpg',
                'user_photo' => 'user_photos/no_profile.png',
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('donor')->insert($donors);
    }
}
