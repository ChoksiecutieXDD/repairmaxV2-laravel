<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the pre-created admin account
        $user = User::updateOrCreate(
            ['email' => 'repairmaxsample@gmail.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'Repairmax',
                'phone' => '1234567890',
                'password' => Hash::make('Admin@12345'), // Use strong password
                'address' => 'Admin Office',
                'city' => 'City',
                'state' => 'State',
                'postal_code' => '00000',
                'role' => 'admin', // Set role as admin
                'is_verified' => 1, // Admin is verified
                'is_active' => 1, // Admin is active
                'admin_level' => 'super_admin',
                'department' => 'Management',
                'job_title' => 'System Administrator',
                'permissions' => json_encode(['all']),
                'admin_notes' => 'Default super admin account created during installation',
            ]
        );
    }
}
