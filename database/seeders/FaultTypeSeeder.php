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
                'image_path' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=400&fit=crop',
            ],
            [
                'name' => 'LCD/Screen Replacement',
                'description' => 'Replaces cracked, flickering, unresponsive, or damaged screens with a new LCD/display assembly.',
                'base_price' => 2500,
                'image_path' => 'https://images.unsplash.com/photo-1592286927505-c0a5ebb5b0f9?w=400&h=400&fit=crop',
            ],
            [
                'name' => 'Battery Replacement',
                'description' => 'Installs a new battery for devices experiencing fast battery drain, overheating, or unexpected shutdowns.',
                'base_price' => 1200,
                'image_path' => 'https://images.unsplash.com/photo-1625948515291-69613efd103f?w=400&h=400&fit=crop',
            ],
            [
                'name' => 'Charging Port Repair',
                'description' => 'Fixes charging issues caused by damaged, loose, or dirty charging ports to restore proper power connection.',
                'base_price' => 800,
                'image_path' => 'https://images.unsplash.com/photo-1591290621749-2f492f3b4f52?w=400&h=400&fit=crop',
            ],
            [
                'name' => 'Speaker Repair',
                'description' => 'Repairs distorted, low-volume, or non-working speakers to improve device audio output quality.',
                'base_price' => 700,
                'image_path' => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=400&h=400&fit=crop',
            ],
            [
                'name' => 'Microphone Repair',
                'description' => 'Resolves microphone issues affecting voice calls, recordings, or voice command functionality.',
                'base_price' => 700,
                'image_path' => 'https://images.unsplash.com/photo-1611339555312-e607c04352fa?w=400&h=400&fit=crop',
            ],
            [
                'name' => 'Camera Repair',
                'description' => 'Repairs blurry, malfunctioning, or damaged front and rear cameras for proper photo and video performance.',
                'base_price' => 1500,
                'image_path' => 'https://images.unsplash.com/photo-1612198188060-c7c2a3b66eae?w=400&h=400&fit=crop',
            ],
            [
                'name' => 'Power Button Repair',
                'description' => 'Fixes stuck, loose, or unresponsive power buttons to restore device power control functions.',
                'base_price' => 600,
                'image_path' => 'https://images.unsplash.com/photo-1589949202836-f0c1c37b7b43?w=400&h=400&fit=crop',
            ],
            [
                'name' => 'Volume Button Repair',
                'description' => 'Repairs faulty volume buttons that no longer adjust sound levels properly.',
                'base_price' => 600,
                'image_path' => 'https://images.unsplash.com/photo-1606933248051-5e41a6d6bd5c?w=400&h=400&fit=crop',
            ],
            [
                'name' => 'Water Damage Repair',
                'description' => 'Performs cleaning, diagnostics, and component repair for devices exposed to water or liquid damage.',
                'base_price' => 1500,
                'image_path' => 'https://images.unsplash.com/photo-1589949202836-f0c1c37b7b43?w=400&h=400&fit=crop',
            ],
            [
                'name' => 'Back Glass Replacement',
                'description' => 'Replaces cracked or damaged back glass panels to restore device appearance and protection.',
                'base_price' => 1800,
                'image_path' => 'https://images.unsplash.com/photo-1573395606837-b1246eb54b56?w=400&h=400&fit=crop',
            ],
            [
                'name' => 'Software Troubleshooting',
                'description' => 'Diagnoses and resolves software-related problems such as lagging, freezing, crashes, and app errors.',
                'base_price' => 500,
                'image_path' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=400&h=400&fit=crop',
            ],
            [
                'name' => 'Operating System Reinstallation',
                'description' => 'Reinstalls the device operating system to fix severe software corruption or system failures.',
                'base_price' => 800,
                'image_path' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=400&h=400&fit=crop',
            ],
            [
                'name' => 'Boot Loop Fix',
                'description' => 'Repairs devices stuck on startup logos or continuously restarting during boot.',
                'base_price' => 900,
                'image_path' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=400&fit=crop',
            ],
            [
                'name' => 'Signal/Network Repair',
                'description' => 'Resolves issues related to weak signal, no service, SIM card detection, or network connectivity.',
                'base_price' => 1200,
                'image_path' => 'https://images.unsplash.com/photo-1571330735066-03aaa9429d89?w=400&h=400&fit=crop',
            ],
            [
                'name' => 'Face ID / Fingerprint Sensor Repair',
                'description' => 'Repairs biometric authentication features that are not detecting fingerprints or facial recognition properly.',
                'base_price' => 2000,
                'image_path' => 'https://images.unsplash.com/photo-1607083206968-13f3920ba313?w=400&h=400&fit=crop',
            ],
            [
                'name' => 'Motherboard Repair',
                'description' => 'Diagnoses and repairs damaged motherboard components affecting overall device functionality.',
                'base_price' => 3500,
                'image_path' => 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=400&h=400&fit=crop',
            ],
            [
                'name' => 'Overheating Issue Repair',
                'description' => 'Identifies and resolves hardware or software causes of excessive device heating.',
                'base_price' => 1000,
                'image_path' => 'https://images.unsplash.com/photo-1550355291-bbee04a92027?w=400&h=400&fit=crop',
            ],
            [
                'name' => 'Wi-Fi / Bluetooth Repair',
                'description' => 'Repairs wireless connectivity issues affecting Wi-Fi and Bluetooth performance.',
                'base_price' => 1200,
                'image_path' => 'https://images.unsplash.com/photo-1589941013453-ec89f33b5e95?w=400&h=400&fit=crop',
            ],
            [
                'name' => 'Data Recovery Service',
                'description' => 'Attempts to recover lost, deleted, or inaccessible files, photos, videos, and documents from damaged devices.',
                'base_price' => 2500,
                'image_path' => 'https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=400&h=400&fit=crop',
            ],
        ];

        foreach ($services as $service) {
            FaultType::create($service);
        }
    }
}
