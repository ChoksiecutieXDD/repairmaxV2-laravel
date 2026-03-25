<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Generate a unique booking reference
            $table->string('tracking_code')->unique();

            // Device Info
            $table->string('device_brand');
            $table->string('device_model');
            $table->string('fault_category');
            $table->text('description');
            $table->string('photo_path')->nullable(); // For the uploaded image

            // Schedule
            $table->date('pref_date');
            $table->time('pref_time');
            $table->string('status')->default('Pending'); // Pending, Approved, Completed

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
