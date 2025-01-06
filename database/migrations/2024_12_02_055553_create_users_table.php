<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {

        Schema::create('user_account', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100)->unique();
            $table->string('email', 100)->unique();
            $table->string('password', 100);
            $table->string('account_type', 50); // individual or Organization
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });

        // Create roles table
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('role_name', 50)->unique();
            $table->timestamps();
        });

        // Create user_roles table
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user_account')->onDelete('cascade');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
        });

        // Create location table
        Schema::create('location', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user_account')->onDelete('cascade');
            $table->string('region', 100);
            $table->string('province', 100);
            $table->string('city_municipality', 100);
            $table->string('barangay', 100);
            $table->string('full_address', 255);
            $table->decimal('latitude', 9, 6)->nullable();
            $table->decimal('longitude', 9, 6)->nullable();
            $table->timestamps();
        });

        // Create donor table
        Schema::create('donor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user_account')->onDelete('cascade');
            $table->string('first_name', 100);
            $table->string('last_name', 100)->nullable();
            $table->string('contact', 15)->unique();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('id_type', 50);
            $table->string('id_image', 255);
            $table->string('user_photo', 255);
            $table->timestamps();
        });

        // Create volunteer table
        Schema::create('volunteer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user_account')->onDelete('cascade');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('contact', 15)->unique();
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('id_type', 50);
            $table->string('id_image', 255);
            $table->string('user_photo', 255);
            $table->foreignId('chapter_id')->nullable()->constrained('chapter')->onDelete('set null');
            $table->enum('pref_services', ['Collect Donations', 'Relief Operations', 'Health Welfware', 'Emergency Response', 'General'])->nullable();
            $table->enum('availability', ['Weekday', 'Weekend', 'Holiday', 'In time of Disasters']);
            $table->enum('availability_time', ['Morning', 'Afternoon', 'Night', 'On-Call', 'Whole-Day']);
            $table->timestamps();
        });

        Schema::create('volunteer_appointment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('volunteer_id')->constrained('volunteer')->onDelete('cascade');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->timestamps();
        });

        // Insert default roles
        DB::table('roles')->insert([
            ['role_name' => 'Donor'],
            ['role_name' => 'Volunteer'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('volunteer');
        Schema::dropIfExists('donee');
        Schema::dropIfExists('donor');
        Schema::dropIfExists('location');
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('user_account');
        Schema::dropIfExists('volunteer_appointment');
    }
};
