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
            $table->decimal('service_cost', 10, 2)->default(0)->comment('Cost of service labor');
            $table->decimal('parts_cost', 10, 2)->default(0)->comment('Cost of parts used');
            $table->decimal('total_cost', 10, 2)->default(0)->comment('Total cost = service_cost + parts_cost');
            $table->decimal('profit', 10, 2)->default(0)->comment('Profit = final_cost - total_cost');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['service_cost', 'parts_cost', 'total_cost', 'profit']);
        });
    }
};
