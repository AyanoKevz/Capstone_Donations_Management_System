<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inquiry', function (Blueprint $table) {
            $table->increments('inquiry_id');
            $table->string('name', 100);
            $table->string('email', 100);
            $table->string('contact', 100);
            $table->string('subject', 140)->nullable();
            $table->text('message');
            $table->string('status', 50);
            $table->timestamp('submitted_at')->nullable();
            $table->unsignedInteger('handled_by_admin_id')->nullable();

            $table->foreign('handled_by_admin_id')
                ->references('admin_id')
                ->on('admin')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiry');
    }
};
