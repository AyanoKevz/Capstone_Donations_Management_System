<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Inquiry;

class InquirySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inquiry::factory()->count(10)->create();
    }
}
