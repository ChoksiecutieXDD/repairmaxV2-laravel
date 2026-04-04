<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Add cost, invoice, and completion tracking fields
            $table->decimal('quote', 10, 2)->nullable()->after('status');
            $table->decimal('final_cost', 10, 2)->nullable()->after('quote');
            $table->text('completion_notes')->nullable()->after('final_cost');
            $table->string('invoice_number')->nullable()->unique()->after('completion_notes');
            $table->timestamp('completed_at')->nullable()->after('invoice_number');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['quote', 'final_cost', 'completion_notes', 'invoice_number', 'completed_at']);
        });
    }
};
