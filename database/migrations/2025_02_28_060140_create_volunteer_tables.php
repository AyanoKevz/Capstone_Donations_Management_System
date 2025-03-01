<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Create the 'event' table
        Schema::create('event', function (Blueprint $table) {
            $table->id();
            $table->string('event_name', 100);
            $table->text('event_description')->nullable();
            $table->dateTime('event_date');
            $table->timestamps();
        });

        // Create the 'volunteer_activity' table
        Schema::create('volunteer_activity', function (Blueprint $table) {
            $table->id();
            $table->foreignId('volunteer_id')->constrained('volunteer')->onDelete('cascade');
            $table->text('task_description');
            $table->integer('hours_worked');
            $table->foreignId('event_id')->nullable()->constrained('event')->nullOnDelete();
            $table->foreignId('distribution_id')->nullable()->constrained('distribution')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('volunteer_activity');
        Schema::dropIfExists('event');
    }
};
