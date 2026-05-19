<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Appointment;
use App\Mail\BookingConfirmationEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

try {
    echo "=== Testing Guest Booking Email ===\n\n";
    
    // Create or find user
    $user = User::firstOrCreate(
        ['email' => 'andrewituriaga06@gmail.com'],
        [
            'first_name' => 'Andrew',
            'last_name' => 'Test',
            'phone' => '09123456789',
            'password' => bcrypt('test123'),
            'role' => 'user',
            'is_verified' => false,
        ]
    );
    
    echo "✓ User found/created: {$user->first_name} {$user->last_name}\n";
    
    // Create appointment
    $appointment = Appointment::create([
        'user_id' => $user->id,
        'tracking_code' => 'RPR-' . strtoupper(uniqid()),
        'device_brand' => 'iPhone',
        'device_model' => '14 Pro Max',
        'fault_category' => 'Screen Repair',
        'description' => 'Screen is cracked and not responding to touch',
        'photo_paths' => [],
        'status' => 'Pending',
        'pref_date' => now()->addDay(),
        'pref_time' => '10:00:00',
    ]);
    
    echo "✓ Appointment created with Tracking Code: {$appointment->tracking_code}\n";
    
    // Send email
    echo "\nSending email to: {$user->email}\n";
    
    Mail::to($user->email)->send(new BookingConfirmationEmail(
        $user->first_name,
        $user->last_name,
        $appointment->tracking_code,
        $appointment->device_brand,
        $appointment->device_model,
        $appointment->fault_category,
        $appointment->description,
        $user->email
    ));
    
    echo "✓ Email sent successfully!\n\n";
    echo "=== Test Complete ===\n";
    echo "Check your email: {$user->email}\n";
    echo "Tracking Code: {$appointment->tracking_code}\n";
    
} catch (\Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "Stack: " . $e->getTraceAsString() . "\n";
    exit(1);
}
