<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Repair;
use Illuminate\Database\Seeder;

class RepairSeeder extends Seeder
{
    public function run(): void
    {
        Repair::truncate();
        $users = User::where('role', 'user')->get();

        $deviceNames = ['iPhone 14 Pro', 'Samsung Galaxy S21', 'MacBook Pro 16', 'iPad Air', 'Google Pixel 7'];
        $issueTypes = ['Screen Replacement', 'Battery Replacement', 'Water Damage', 'Hardware Repair', 'Software Issue'];
        $statuses = ['Pending', 'In Progress', 'Completed'];

        $repairCount = 1;
        foreach ($users as $user) {
            for ($i = 0; $i < 3; $i++) {
                $trackingCode = 'RM-' . str_pad($repairCount, 5, '0', STR_PAD_LEFT);
                Repair::updateOrCreate(
                    ['tracking_code' => $trackingCode],
                    [
                        'user_id' => $user->id,
                        'device_name' => $deviceNames[array_rand($deviceNames)],
                        'issue_type' => $issueTypes[array_rand($issueTypes)],
                        'status' => $statuses[array_rand($statuses)],
                        'quote' => rand(500, 5000),
                        'notes' => 'Device inspection completed. Estimate provided to customer.',
                    ]
                );
                $repairCount++;
            }
        }
    }
}
