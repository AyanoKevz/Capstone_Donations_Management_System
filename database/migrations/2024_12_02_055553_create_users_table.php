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

        // Create user_account table
        Schema::create('user_account', function (Blueprint $table) {
            $table->id();
            $table->string('username', 100)->unique();
            $table->string('email', 100)->unique();
            $table->string('password', 100);
            $table->string('account_type', 50); // individual or Organization
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });

        Schema::create(
            'roles',
            function (Blueprint $table) {
                $table->id();
                $table->string('role_name', 50)->unique();
                $table->timestamps();
            }
        );

        // Create user_roles table
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user_account')->onDelete('cascade');
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
        });

        // Create location table
        Schema::create('location', function (Blueprint $table) {
            $table->id();
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
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100);
            $table->string('contact', 15)->unique();
            $table->date('birthday');
            $table->string('gender', 10)->nullable();
            $table->string('id_type', 50)->nullable();
            $table->string('id_image', 255)->nullable();
            $table->string('user_photo', 255)->nullable();
            $table->foreignId('location_id')->nullable()->constrained('location')->onDelete('set null');
            $table->timestamps();
        });

        // Create donee table
        Schema::create('donee', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user_account')->onDelete('cascade');
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100);
            $table->string('contact', 15)->unique();
            $table->date('birthday');
            $table->string('gender', 10)->nullable();
            $table->string('id_type', 50)->nullable();
            $table->string('id_image', 255)->nullable();
            $table->string('user_photo', 255)->nullable();
            $table->foreignId('location_id')->nullable()->constrained('location')->onDelete('set null');
            $table->timestamps();
        });

        // Create volunteer table
        Schema::create('volunteer', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('user_account')->onDelete('cascade');
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100);
            $table->string('contact', 15)->unique();
            $table->date('birthday');
            $table->string('gender', 10)->nullable();
            $table->string('id_type', 50)->nullable();
            $table->string('id_image', 255)->nullable();
            $table->string('user_photo', 255)->nullable();
            $table->foreignId('location_id')->nullable()->constrained('location')->onDelete('set null');
            $table->enum('pref_services', ['collect_donations', 'distribute_donations', 'provide_support']);
            $table->enum('availability', ['weekday', 'weekend', 'holiday', 'disasters']);
            $table->enum('availability_time', ['morning', 'afternoon', 'night', 'on_call', 'whole_day']);

            // New fields for Education and Profession
            $table->enum(
                'educational_attainment',
                [
                    'grade_school_graduate',
                    'high_school_graduate',
                    'vocational_short_courses_graduate',
                    'college_graduate',
                    'masters_degree_holder',
                    'doctorate_degree_holder'
                ]
            )->nullable();
            $table->boolean('is_studying')->default(true);
            $table->boolean('is_employed')->default(true);

            $table->timestamps();
        });

        // Insert default roles
        DB::table('roles')->insert([
            ['role_name' => 'Donor'],
            ['role_name' => 'Donee'],
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
    }
};
