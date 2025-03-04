<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            InquirySeeder::class,
            PooledResourceSeeder::class,
            PooledFundSeeder::class,
            DonorSeeder::class,
            VolunteerSeeder::class,
            AdminSeeder::class,

        ]);
    }
}
