<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            // Links this repair to a specific user
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            $table->string('tracking_code')->unique(); // e.g., RM-84729
            $table->string('device_name');             // e.g., iPhone 14 Pro
            $table->string('issue_type');              // e.g., Screen Replacement
            $table->string('status')->default('Pending'); // Pending, In Progress, Completed
            $table->decimal('quote', 10, 2)->nullable();  // e.g., 1500.00
            $table->text('notes')->nullable();         // Extra details from the technician

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};
