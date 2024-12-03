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
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('username', 100)->unique();
            $table->string('email', 100)->unique();
            $table->string('password', 100);
            $table->string('profile_image')->nullable();
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
            $table->timestamp('posted_at')->useCurrent();
        });

        DB::table('admin')->insert([
            'name' => 'UniAid',
            'username' => 'admin',
            'email' => 'uniaid2024@gmail.com',
            'password' => Hash::make('uniaid123'),
            'profile_image' => 'assets/img/no_profile.png',
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
    }
};
