<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('volunteer_activity', function (Blueprint $table) {
            $table->id();
            $table->foreignId('volunteer_id')->constrained('volunteer')->onDelete('cascade');
            $table->foreignId('donation_id')->nullable()->constrained('donation')->nullOnDelete();
            $table->foreignId('distribution_id')->nullable()->constrained('distribution')->nullOnDelete();
            $table->date('activity_date')->nullable();
            $table->text('task_description');
            $table->integer('hours_worked')->nullable();
            $table->enum('status', ['pending', 'accepted', 'declined', 'completed', 'ongoing'])->default('pending');
            $table->string('proof_image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('volunteer_activity');
    }
};
