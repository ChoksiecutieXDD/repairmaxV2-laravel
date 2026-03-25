<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the AdminSeeder to create the pre-created admin account
        $this->call([
            AdminSeeder::class,
            SettingSeeder::class,
            \Database\Seeders\InventoryItemSeeder::class,
        ]);
    }
}
