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
            $table->string('service_method')->default('Drop-off')->comment('Drop-off or Pickup');
            $table->string('address')->nullable()->comment('Customer address for pickup service');
            $table->string('city')->nullable()->comment('City for pickup service');
            $table->decimal('additional_fee', 10, 2)->default(0)->comment('Additional fees for pickup or other services');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn(['service_method', 'address', 'city', 'additional_fee']);
        });
    }
};
