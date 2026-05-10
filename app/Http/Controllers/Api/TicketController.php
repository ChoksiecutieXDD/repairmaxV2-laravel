<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class TicketController extends Controller
{
    /**
     * Create a new repair ticket (appointment) via API.
     */
    public function store(Request $request)
    {
        // Security check for n8n
        if ($request->header('X-N8N-SECRET') !== env('N8N_WEBHOOK_SECRET', 'repairmax_secret_123')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        Log::info('Incoming n8n Ticket Request', $request->all());

        try {
            $validated = $request->validate([
                'device_brand' => 'required|string',
                'device_model' => 'required|string',
                'fault_category' => 'required|string',
                'description' => 'required|string',
                'pref_date' => 'required|date',
                'pref_time' => 'required', // HH:MM format
                'user_id' => 'nullable|integer',
            ]);

            // Generate a unique tracking code (RX-XXXXX)
            $trackingCode = 'RX-' . strtoupper(Str::random(6));

            $appointment = Appointment::create([
                'user_id' => $validated['user_id'] ?? 8, // Default to test user if not provided
                'tracking_code' => $trackingCode,
                'device_brand' => $validated['device_brand'],
                'device_model' => $validated['device_model'],
                'fault_category' => $validated['fault_category'],
                'description' => $validated['description'],
                'pref_date' => $validated['pref_date'],
                'pref_time' => $validated['pref_time'],
                'status' => 'Pending',
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Ticket created successfully',
                'tracking_code' => $appointment->tracking_code,
                'appointment_id' => $appointment->id,
            ], 201);

        } catch (\Exception $e) {
            Log::error('API Ticket Creation Failed', ['error' => $e->getMessage()]);
            
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create ticket: ' . $e->getMessage(),
            ], 500);
        }
    }
}
