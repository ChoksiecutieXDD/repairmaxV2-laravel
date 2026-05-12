<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\AdminProfile;
use App\Models\Notification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing data and reset IDs
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        // Create Admin
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'System',
            'email' => 'admin@admin.com',
            'phone' => '0000000000',
            'password' => Hash::make('adminadmin'),
            'role' => 'admin',
            'is_verified' => true,
            'is_active' => true,
            'admin_level' => 'super_admin',
            'department' => 'Management',
            'job_title' => 'System Administrator',
            'permissions' => ['all'],
            'status' => 'active',
        ]);

        // Create Regular User
        User::create([
            'first_name' => 'Regular',
            'last_name' => 'User',
            'email' => 'user@user.com',
            'phone' => '1111111111',
            'password' => Hash::make('useruser'),
            'role' => 'user',
            'is_verified' => true,
            'is_active' => true,
            'status' => 'active',
            'preferred_language' => 'en',
            'timezone' => 'UTC',
        ]);
    }
}
