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
        // Create Admin
        User::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'System',
                'phone' => '0000000000',
                'password' => Hash::make('adminadmin'),
                'role' => 'admin',
                'is_verified' => true,
                'is_active' => true,
                'admin_level' => 'super_admin',
                'department' => 'Management',
                'job_title' => 'System Administrator',
                'permissions' => json_encode(['all']),
                'status' => 'active',
            ]
        );

        // Create Regular User
        User::updateOrCreate(
            ['email' => 'user@user.com'],
            [
                'first_name' => 'Regular',
                'last_name' => 'User',
                'phone' => '1111111111',
                'password' => Hash::make('useruser'),
                'role' => 'user',
                'is_verified' => true,
                'is_active' => true,
                'status' => 'active',
                'preferred_language' => 'en',
                'timezone' => 'UTC',
            ]
        );
    }
}
