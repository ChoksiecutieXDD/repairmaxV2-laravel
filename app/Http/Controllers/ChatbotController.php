<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Appointment;

class ChatbotController extends Controller
{
    /**
     * Handle incoming chatbot messages and proxy them to n8n.
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'session_id' => 'nullable|string|max:100',
        ]);

        try {
            // Local n8n webhook URL (running in Docker)
            // Using 'localhost' instead of '127.0.0.1' for better Docker-to-Host compatibility
            $n8nWebhookUrl = env('N8N_WEBHOOK_URL', 'http://localhost:5678/webhook-test/chatbot');

            $response = Http::asJson()->withHeaders([
                'X-N8N-SECRET' => env('N8N_WEBHOOK_SECRET', 'repairmax_secret_123'),
            ])->post($n8nWebhookUrl, [
                'message' => $request->message,
                'user_id' => \Illuminate\Support\Facades\Auth::id() ?? 'anonymous',
                'session_id' => $request->session_id ?? 'anonymous',
                'timestamp' => now()->toIso8601String(),
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (is_array($data)) {
                    if (isset($data['reply']) && is_string($data['reply'])) {
                        $data['reply'] = $this->parseAndHandleToolCalls($data['reply']);
                    }
                    if (isset($data['output']) && is_string($data['output'])) {
                        $data['output'] = $this->parseAndHandleToolCalls($data['output']);
                    }
                }
                
                return response()->json($data);
            }

            Log::error('n8n Chatbot Error', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);

            return response()->json([
                'reply' => "I'm having trouble connecting to my brain right now. Please try again in a moment!"
            ], 500);

        } catch (\Exception $e) {
            Log::error('Chatbot Controller Exception', ['error' => $e->getMessage()]);
            
            return response()->json([
                'reply' => "Sorry, I encountered an internal error. Please contact support if this persists."
            ], 500);
        }
    }

    /**
     * Intercept and handle raw tool calls (e.g. track_booking) inside the bot's response text.
     */
    private function parseAndHandleToolCalls(string $text): string
    {
        if (preg_match('/\(function=track_booking>(\{.*?\})\)?/s', $text, $matches)) {
            $jsonStr = $matches[1];
            $params = json_decode($jsonStr, true);
            
            if ($params) {
                $ref = $params['parameters0_Value'] ?? $params['booking_reference'] ?? null;
                $email = $params['parameters1_Value'] ?? $params['email'] ?? null;
                
                if ($ref && $email) {
                    $appointment = Appointment::where(function ($query) use ($ref) {
                            $query->where('tracking_code', $ref)
                                  ->orWhere('booking_number', $ref);
                        })
                        ->whereHas('user', function ($query) use ($email) {
                            $query->where('email', $email);
                        })->first();
                    
                    if ($appointment) {
                        $statusReply = "Here is the status for your ticket **{$appointment->tracking_code}**:\n\n";
                        $statusReply .= "- **Device**: {$appointment->device_brand} {$appointment->device_model}\n";
                        $statusReply .= "- **Status**: " . ucfirst($appointment->status) . "\n";
                        if ($appointment->fault_category) {
                            $statusReply .= "- **Issue**: {$appointment->fault_category}\n";
                        }
                        if ($appointment->status === 'completed') {
                            $statusReply .= "\nYour device is ready for pickup!";
                        } else if (in_array(strtolower($appointment->status), ['scheduled', 'pending', 'in_progress', 'processing'])) {
                            $statusReply .= "\nWe are currently working on it. We'll notify you once there's an update.";
                        }
                    } else {
                        $statusReply = "No active repair booking found matching reference \"{$ref}\" and email \"{$email}\".";
                    }
                    
                    $text = str_replace($matches[0], $statusReply, $text);
                    $text = str_replace("Unfortunately, it seems there was an issue with my previous response. Let me try again.", "", $text);
                    $text = trim($text);
                }
            }
        }
        
        return $text;
    }

    /**
     * Track a ticket directly by tracking code.
     */
    public function trackTicket(Request $request)
    {
        $request->validate([
            'tracking_code' => 'required|string|max:50',
        ]);

        try {
            $appointment = Appointment::where('tracking_code', $request->tracking_code)->first();

            if (!$appointment) {
                return response()->json([
                    'reply' => "I couldn't find a ticket with tracking code: **{$request->tracking_code}**. Please check the code and try again."
                ]);
            }

            $reply = "Here is the status for your ticket **{$appointment->tracking_code}**:\n\n";
            $reply .= "- **Device**: {$appointment->device_brand} {$appointment->device_model}\n";
            $reply .= "- **Status**: ".ucfirst($appointment->status)."\n";
            
            if ($appointment->fault_category) {
                $reply .= "- **Issue**: {$appointment->fault_category}\n";
            }

            if ($appointment->status === 'completed') {
                $reply .= "\nYour device is ready for pickup!";
            } else if ($appointment->status === 'scheduled' || $appointment->status === 'pending') {
                $reply .= "\nWe are currently working on it. We'll notify you once there's an update.";
            }

            return response()->json([
                'reply' => $reply
            ]);

        } catch (\Exception $e) {
            Log::error('Chatbot Track Ticket Exception', ['error' => $e->getMessage()]);
            
            return response()->json([
                'reply' => "Sorry, I encountered an internal error while tracking your ticket. Please contact support."
            ], 500);
        }
    }
}
