<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FaultType;

class FaultTypeSeeder extends Seeder
{
    public function run(): void
    {
        // Truncate existing fault types to prevent duplicates
        FaultType::truncate();

        $services = [
            [
                'name' => 'Audio Jack Repair',
                'description' => 'Repairs loose, damaged, or non-functional audio jacks to restore proper headphone and earphone connectivity.',
                'base_price' => 500,
                'image_path' => 'img/blank-picture.png',
            ],
            [
                'name' => 'LCD/Screen Replacement',
                'description' => 'Replaces cracked, flickering, unresponsive, or damaged screens with a new LCD/display assembly.',
                'base_price' => 2500,
                'image_path' => 'img/blank-picture.png',
            ],
            [
                'name' => 'Battery Replacement',
                'description' => 'Installs a new battery for devices experiencing fast battery drain, overheating, or unexpected shutdowns.',
                'base_price' => 1200,
                'image_path' => 'img/blank-picture.png',
            ],
            [
                'name' => 'Charging Port Repair',
                'description' => 'Fixes charging issues caused by damaged, loose, or dirty charging ports to restore proper power connection.',
                'base_price' => 800,
                'image_path' => 'img/blank-picture.png',
            ],
            [
                'name' => 'Speaker Repair',
                'description' => 'Repairs distorted, low-volume, or non-working speakers to improve device audio output quality.',
                'base_price' => 700,
                'image_path' => 'img/blank-picture.png',
            ],
            [
                'name' => 'Microphone Repair',
                'description' => 'Resolves microphone issues affecting voice calls, recordings, or voice command functionality.',
                'base_price' => 700,
                'image_path' => 'img/blank-picture.png',
            ],
            [
                'name' => 'Camera Repair',
                'description' => 'Repairs blurry, malfunctioning, or damaged front and rear cameras for proper photo and video performance.',
                'base_price' => 1500,
                'image_path' => 'img/blank-picture.png',
            ],
            [
                'name' => 'Power Button Repair',
                'description' => 'Fixes stuck, loose, or unresponsive power buttons to restore device power control functions.',
                'base_price' => 600,
                'image_path' => 'img/blank-picture.png',
            ],
            [
                'name' => 'Volume Button Repair',
                'description' => 'Repairs faulty volume buttons that no longer adjust sound levels properly.',
                'base_price' => 600,
                'image_path' => 'img/blank-picture.png',
            ],
            [
                'name' => 'Water Damage Repair',
                'description' => 'Performs cleaning, diagnostics, and component repair for devices exposed to water or liquid damage.',
                'base_price' => 1500,
                'image_path' => 'img/blank-picture.png',
            ],
            [
                'name' => 'Back Glass Replacement',
                'description' => 'Replaces cracked or damaged back glass panels to restore device appearance and protection.',
                'base_price' => 1800,
                'image_path' => 'img/blank-picture.png',
            ],
            [
                'name' => 'Software Troubleshooting',
                'description' => 'Diagnoses and resolves software-related problems such as lagging, freezing, crashes, and app errors.',
                'base_price' => 500,
                'image_path' => 'img/blank-picture.png',
            ],
            [
                'name' => 'Operating System Reinstallation',
                'description' => 'Reinstalls the device operating system to fix severe software corruption or system failures.',
                'base_price' => 800,
                'image_path' => 'img/blank-picture.png',
            ],
            [
                'name' => 'Boot Loop Fix',
                'description' => 'Repairs devices stuck on startup logos or continuously restarting during boot.',
                'base_price' => 900,
                'image_path' => 'img/blank-picture.png',
            ],
            [
                'name' => 'Signal/Network Repair',
                'description' => 'Resolves issues related to weak signal, no service, SIM card detection, or network connectivity.',
                'base_price' => 1200,
                'image_path' => 'img/blank-picture.png',
            ],
            [
                'name' => 'Face ID / Fingerprint Sensor Repair',
                'description' => 'Repairs biometric authentication features that are not detecting fingerprints or facial recognition properly.',
                'base_price' => 2000,
                'image_path' => 'img/blank-picture.png',
            ],
            [
                'name' => 'Motherboard Repair',
                'description' => 'Diagnoses and repairs damaged motherboard components affecting overall device functionality.',
                'base_price' => 3500,
                'image_path' => 'img/blank-picture.png',
            ],
            [
                'name' => 'Overheating Issue Repair',
                'description' => 'Identifies and resolves hardware or software causes of excessive device heating.',
                'base_price' => 1000,
                'image_path' => 'img/blank-picture.png',
            ],
            [
                'name' => 'Wi-Fi / Bluetooth Repair',
                'description' => 'Repairs wireless connectivity issues affecting Wi-Fi and Bluetooth performance.',
                'base_price' => 1200,
                'image_path' => 'img/blank-picture.png',
            ],
            [
                'name' => 'Data Recovery Service',
                'description' => 'Attempts to recover lost, deleted, or inaccessible files, photos, videos, and documents from damaged devices.',
                'base_price' => 2500,
                'image_path' => 'img/blank-picture.png',
            ],
        ];

        foreach ($services as $service) {
            FaultType::create($service);
        }
    }
}
