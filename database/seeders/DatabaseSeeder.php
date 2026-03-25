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
<<<<<<< HEAD
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
=======
        // Call the AdminSeeder to create the pre-created admin account
        $this->call([
            AdminSeeder::class,
>>>>>>> a8364796a4dfa65ab645716b5f9e22b7baa2ae61
        ]);
    }
}
