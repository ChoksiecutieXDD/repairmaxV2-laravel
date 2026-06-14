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
        Schema::table('appointments', function (Blueprint $table) {
            $table->enum('cancellation_reason', ['user_requested', 'user_no_show', 'technician_unavailable', 'scheduling_conflict', 'other'])->nullable();
            $table->integer('reschedule_count')->default(0);
            $table->boolean('is_rescheduled')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['cancellation_reason', 'reschedule_count', 'is_rescheduled']);
        });
    }
};
