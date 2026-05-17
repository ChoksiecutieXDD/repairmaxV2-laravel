<?php

namespace Database\Seeders;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        Notification::truncate();

        $users = User::where('role', 'user')->get();
        $admins = User::where('role', 'admin')->get();

        foreach ($users as $user) {
            // Create appointment notifications for users
            Notification::create([
                'user_id' => $user->id,
                'admin_id' => $admins->random()->id,
                'title' => 'Appointment Scheduled',
                'message' => 'Your repair appointment has been scheduled. Please check the details in your booking.',
                'type' => 'appointment_confirmation',
                'related_model' => 'Appointment',
                'related_id' => null,
                'is_read' => false,
            ]);

            // Create repair status notifications
            Notification::create([
                'user_id' => $user->id,
                'admin_id' => $admins->random()->id,
                'title' => 'Repair Status Update',
                'message' => 'Your repair is currently in progress. We will notify you once it is completed.',
                'type' => 'repair_update',
                'related_model' => 'Repair',
                'related_id' => null,
                'is_read' => false,
            ]);

            // Create read notifications
            Notification::create([
                'user_id' => $user->id,
                'admin_id' => $admins->random()->id,
                'title' => 'Repair Completed',
                'message' => 'Your repair has been completed successfully. Please collect your device.',
                'type' => 'repair_completed',
                'related_model' => 'Repair',
                'related_id' => null,
                'is_read' => true,
                'read_at' => now()->subDays(2),
            ]);
        }

        // Admin notifications
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'admin_id' => $admins->whereNotIn('id', [$admin->id])->random()?->id,
                'title' => 'New Admin Created',
                'message' => 'A new admin account has been created in the system.',
                'type' => 'admin_alert',
                'related_model' => 'User',
                'related_id' => null,
                'is_read' => false,
            ]);

            Notification::create([
                'user_id' => $admin->id,
                'title' => 'Daily Report Ready',
                'message' => 'Your daily activity report is ready. Click to view the details.',
                'type' => 'system_alert',
                'is_read' => false,
            ]);
        }
    }
}
