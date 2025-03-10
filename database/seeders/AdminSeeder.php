<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Define default image path
        $defaultImagePath = 'assets/img/PRC_logo.png';

        // Ensure the default image exists
        if (!file_exists(public_path($defaultImagePath))) {
            throw new \Exception("Default image file not found. Make sure 'PRC_logo.png' exists in 'public/assets/img/'.");
        }

        // Get all chapters
        $chapters = DB::table('chapter')->get();

        // Create admin accounts
        $admins = [];
        foreach ($chapters as $chapter) {
            $username = 'admin_' . Str::lower($chapter->chapter_name);
            $profileImagePath = 'admin_photos/' . Str::random(10) . '_PRC_logo.png';

            // Store the profile image in 'storage/app/public'
            Storage::disk('public')->put($profileImagePath, file_get_contents(public_path($defaultImagePath)));

            // Build admin data
            $admins[] = [
                'name' => 'Admin ' . $chapter->chapter_name,
                'username' => $username,
                'email' => $username . '@example.com',
                'password' => Hash::make('12345678'), // Default password
                'profile_image' =>  $profileImagePath,
                'chapter_id' => $chapter->id,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        // Insert admin data
        DB::table('admin')->insert($admins);
    }
}
