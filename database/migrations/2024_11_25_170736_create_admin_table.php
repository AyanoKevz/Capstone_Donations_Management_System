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
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('admin_id');
            $table->string('name', 100);
            $table->string('username', 100)->unique();
            $table->string('email', 100)->unique();
            $table->string('password', 100);
            $table->timestamps();
        });

        Schema::create('news', function (Blueprint $table) {
            $table->increments('news_id'); // Primary key
            $table->unsignedInteger('admin_id'); // Foreign key to admin
            $table->string('subtitle', 255);
            $table->string('title', 255);
            $table->string('content', 255);
            $table->string('image_url', 255)->nullable(); // Nullable for optional image URL
            $table->timestamp('posted_at')->useCurrent(); // Default to current timestamp

            // Foreign key constraint
            $table->foreign('admin_id')
                ->references('admin_id')
                ->on('admin')
                ->onDelete('cascade'); // Deletes news if the related admin is deleted
        });
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
