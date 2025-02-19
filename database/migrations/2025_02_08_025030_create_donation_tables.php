<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('donation_request', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by_admin_id')->constrained('admin')->onDelete('cascade');
            $table->enum('urgency', ['Low', 'Moderate', 'Critical']);
            $table->enum('cause', [
                'Fire',
                'Flood',
                'Typhoon',
                'Earthquake',
                'Volcanic Eruption',
                'Feeding Program',
                'General'
            ]);
            $table->text('description');
            $table->string('proof_photo_1')->nullable();
            $table->string('proof_photo_2')->nullable();
            $table->string('proof_video')->nullable();
            $table->enum('status', ['Pending', 'Fulfilled', 'Canceled'])->default('pending');
            $table->foreignId('location_id')->constrained('location')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('donation_request_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donation_request_id')->constrained('donation_request')->onDelete('cascade');
            $table->enum('category', ['Basic Needs', 'Clothing and Bedding', 'Hygiene Kits', 'Medical Supplies']);
            $table->string('item', 100);
            $table->integer('quantity');
        });

        Schema::create('donation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->constrained('donor')->onDelete('cascade');
            $table->string('donor_name');
            $table->foreignId('chapter_id')->constrained('chapter')->onDelete('cascade');
            $table->foreignId('donation_request_id')->nullable()->constrained('donation_request')->onDelete('cascade');
            $table->enum('cause', [
                'Fire',
                'Flood',
                'Typhoon',
                'Earthquake',
                'Volcanic Eruption',
                'Feeding Program',
                'General'
            ]);
            $table->enum('donation_method', ['pickup', 'drop-off']);
            $table->string('pickup_address')->nullable();
            $table->dateTime('donation_datetime');
            $table->enum('status', ['pending', 'received', 'ongoing', 'distributed'])->default('pending');
            $table->string('proof_image')->nullable();
            $table->string('tracking_number', 50)->nullable();
            $table->timestamps();
        });


        Schema::create('donation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donation_id')->constrained('donation')->onDelete('cascade');
            $table->foreignId('donation_request_id')->nullable()->constrained('donation_request')->onDelete('cascade');
            $table->enum('category', ['Basic Needs', 'Clothing and Bedding', 'Hygiene Kits', 'Medical Supplies']);
            $table->string('item', 100);
            $table->integer('quantity');
            $table->date('expiration_date')->nullable();
            $table->timestamps();
        });

        Schema::create('pooled_resources', function (Blueprint $table) {
            $table->id();
            $table->string('item', 100);
            $table->integer('quantity');
            $table->foreignId('chapter_id')->constrained('chapter')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('fund_request', function (Blueprint $table) {
            $table->id();
            $table->foreignId('created_by_admin_id')->constrained('admin')->onDelete('cascade');
            $table->foreignId('chapter_id')->constrained('chapter')->onDelete('cascade');
            $table->decimal('amount_needed', 10, 2);
            $table->text('description');
            $table->string('proof_photo_1')->nullable();
            $table->string('proof_photo_2')->nullable();
            $table->string('proof_video')->nullable();
            $table->enum('status', ['pending', 'fulfilled', 'canceled'])->default('pending');
            $table->timestamps();
        });

        Schema::create('cash_donation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->constrained('donor')->onDelete('cascade');
            $table->string('donor_name');
            $table->foreignId('chapter_id')->constrained('chapter')->onDelete('cascade');
            $table->foreignId('fund_request_id')->nullable()->constrained('fund_request')->onDelete('cascade');
            $table->decimal('amount', 10, 2);
            $table->enum('donation_method', ['online', 'drop-off']);
            $table->enum('payment_method', ['bank_transfer', 'credit_card', 'paypal', 'gcash'])->nullable();
            $table->string('proof_payment')->nullable();
            $table->string('transaction_reference', 100)->nullable();
            $table->enum('status', ['pending', 'received', 'ongoing', 'distributed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pooled_resources');
        Schema::dropIfExists('donation_items');
        Schema::dropIfExists('donation');
        Schema::dropIfExists('donation_request_items');
        Schema::dropIfExists('donation_request');
        Schema::dropIfExists('cash_donation');
        Schema::dropIfExists('fund_request');
    }
};
