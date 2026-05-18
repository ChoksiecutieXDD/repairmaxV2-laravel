<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('fault_types', function (Blueprint $table) {
            $table->string('category')->nullable()->after('name');
        });

        // Automatically classify existing services
        $services = DB::table('fault_types')->get();
        foreach ($services as $service) {
            $lowerName = strtolower($service->name);
            $category = 'hardware'; // default
            
            if (str_contains($lowerName, 'screen') || str_contains($lowerName, 'glass') || str_contains($lowerName, 'lcd')) {
                $category = 'screen';
            } elseif (str_contains($lowerName, 'battery') || str_contains($lowerName, 'charge') || str_contains($lowerName, 'power')) {
                $category = 'power';
            } elseif (str_contains($lowerName, 'audio') || str_contains($lowerName, 'speaker') || str_contains($lowerName, 'microphone')) {
                $category = 'audio';
            } elseif (str_contains($lowerName, 'software') || str_contains($lowerName, 'system') || str_contains($lowerName, 'boot') || str_contains($lowerName, 'data')) {
                $category = 'software';
            }

            DB::table('fault_types')
                ->where('id', $service->id)
                ->update(['category' => $category]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fault_types', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};
