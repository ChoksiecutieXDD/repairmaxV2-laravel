<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppointmentSeeder extends Seeder
{
    public function run(): void
    {
        Appointment::truncate();
        $users = User::where('role', 'user')->get();

        $brands = ['Apple', 'Samsung', 'Google', 'OnePlus', 'Xiaomi'];
        $models = ['iPhone 14', 'Galaxy S21', 'Pixel 7', 'OnePlus 11', 'Redmi Note 11'];
        $faultCategories = ['Screen', 'Battery', 'Charging', 'Audio', 'Software'];
        $statuses = ['pending', 'scheduled', 'completed', 'cancelled'];

        foreach ($users as $user) {
            for ($i = 0; $i < 2; $i++) {
                $trackingCode = 'AP-' . strtoupper(uniqid());
                
                Appointment::create([
                    'user_id' => $user->id,
                    'tracking_code' => $trackingCode,
                    'device_brand' => $brands[array_rand($brands)],
                    'device_model' => $models[array_rand($models)],
                    'fault_category' => $faultCategories[array_rand($faultCategories)],
                    'description' => 'Device needs repair and assessment.',
                    'photo_paths' => null,
                    'pref_date' => now()->addDays(rand(1, 30))->format('Y-m-d'),
                    'pref_time' => rand(9, 17) . ':00',
                    'status' => $statuses[array_rand($statuses)],
                ]);
            }
        }
    }
}
