<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    /**
     * Handle incoming chatbot messages and proxy them to n8n.
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
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
                'timestamp' => now()->toIso8601String(),
            ]);

            if ($response->successful()) {
                return response()->json($response->json());
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
}
