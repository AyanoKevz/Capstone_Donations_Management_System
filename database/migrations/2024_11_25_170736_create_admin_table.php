<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('chapter', function (Blueprint $table) {
            $table->id();
            $table->string('chapter_name', 100);
            $table->string('address', 255);
            $table->string('region', 100);
            $table->decimal('latitude', 9, 6)->nullable();
            $table->decimal('longitude', 9, 6)->nullable();
            $table->timestamps();
        });

        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('username', 100)->unique();
            $table->string('email', 100)->unique();
            $table->string('password', 100);
            $table->string('profile_image');
            $table->foreignId('chapter_id')->nullable()->constrained('chapter')->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admin')->onDelete('cascade');
            $table->string('subtitle', 255);
            $table->string('title', 255);
            $table->text('content');
            $table->string('image_url_1', 255)->nullable();
            $table->string('image_url_2', 255)->nullable();
            $table->timestamps();
        });




        Schema::create('inquiry', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('contact', 100);
            $table->string('subject', 140)->nullable();
            $table->text('message');
            $table->string('status', 50);
            $table->timestamp('submitted_at')->nullable();
            $table->foreignId('handled_by_admin_id')->nullable()->constrained('admin')->onDelete('set null');
        });



        DB::table('chapter')->insert([
            [
                'chapter_name' => 'Caloocan',
                'address' => '114 7th Ave, Grace Park East, Caloocan City',
                'region' => 'NCR',
                'latitude' => 14.647229,
                'longitude' => 120.991912,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chapter_name' => 'National Headquarters',
                'address' => '37 EDSA, corner Boni Ave, Mandaluyong, 1550',
                'region' => 'NCR',
                'latitude' => 14.572076,
                'longitude' => 121.046674,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chapter_name' => 'Malabon',
                'address' => 'Gov. Pascual, Brgy. Potrero, Malabon City',
                'region' => 'NCR',
                'latitude' => 14.65768,
                'longitude' => 120.95092,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chapter_name' => 'Manila',
                'address' => 'Gen. Luna, Intramuros, Manila',
                'region' => 'NCR',
                'latitude' => 14.58807,
                'longitude' => 120.9818,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chapter_name' => 'Marikina ',
                'address' => '#240 Rizal cor. P. Gomez, San Roque, Marikina City ',
                'region' => 'NCR',
                'latitude' => 14.6299203,
                'longitude' => 121.096226,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chapter_name' => 'Pasay',
                'address' => '2354 CAA Compound, Aurora Blvd, Pasay City',
                'region' => 'NCR',
                'latitude' => 14.54434,
                'longitude' => 120.99479,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chapter_name' => 'Quezon City',
                'address' => 'Gate 5 Quezon City Hall, Kalayaan Ave, Quezon City',
                'region' => 'NCR',
                'latitude' => 14.64811,
                'longitude' => 121.04996,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chapter_name' => 'Rizal',
                'address' => 'Shaw Boulevard, Brgy. Kapitolyo, Pasig City 1601',
                'region' => 'NCR',
                'latitude' => 14.57554,
                'longitude' => 121.06308,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'chapter_name' => 'Valenzuela',
                'address' => 'Dahlia Street, Villa Teresa Subdivision, Valenzuela City',
                'region' => 'NCR',
                'latitude' => 14.69299,
                'longitude' => 120.9677,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        DB::table('admin')->insert([
            'name' => 'UniAid',
            'username' => 'uniaid_admin',
            'email' => 'uniaid2024@gmail.com',
            'password' => Hash::make('uniaid123'),
            'profile_image' => 'admin_photos/no_profile.png',
            'chapter_id' => '2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin');
        Schema::dropIfExists('news');
        Schema::dropIfExists('inquiry');
        Schema::dropIfExists('chapter');
    }
};
