<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // 1️⃣ Create 'event' first WITHOUT 'task_reference' foreign key
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->string('event_name', 100);
            $table->text('event_description')->nullable();
            $table->dateTime('event_date');
            $table->timestamps();
        });

        // 2️⃣ Create 'volunteer_activity' table
        Schema::create('volunteer_activity', function (Blueprint $table) {
            $table->id();
            $table->foreignId('volunteer_id')->constrained('volunteer')->onDelete('cascade');
            $table->text('task_description');
            $table->integer('hours_worked');
            $table->foreignId('event_id')->nullable()->constrained('event')->nullOnDelete();
            $table->foreignId('distribution_id')->nullable()->constrained('distribution')->nullOnDelete();
            $table->enum('status', ['pending', 'accepted', 'declined', 'completed'])->default('pending');
            $table->timestamps();
        });

        // 3️⃣ Now that 'volunteer_activity' exists, add 'task_reference' to 'event'
        Schema::table('event', function (Blueprint $table) {
            $table->foreignId('task_reference')->nullable()->constrained('volunteer_activity')->nullOnDelete();
        });
    }

    public function down()
    {
        // Drop the foreign key before dropping the tables
        Schema::table('event', function (Blueprint $table) {
            $table->dropForeign(['task_reference']);
        });

        Schema::dropIfExists('volunteer_activity');
        Schema::dropIfExists('event');
    }
};
