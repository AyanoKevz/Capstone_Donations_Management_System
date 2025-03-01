<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAccountSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('user_account')->truncate();
        DB::table('location')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

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
                'username' => 'donor321',
                'email' => 'donor2@example.com',
                'password' => Hash::make('12345678'),
                'account_type' => 'Organization',
                'is_verified' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('user_account')->insert($users);

        // Assign "Donor" role to users and add locations
        $donorRole = DB::table('roles')->where('role_name', 'Donor')->first();
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
                'barangay' => 'Barangay 159',
                'full_address' => 'Random',
                'latitude' => null,
                'longitude' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
