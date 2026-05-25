<?php

namespace App\Http\Controllers\N8n;

use App\Http\Controllers\Controller;
use App\Models\ChatbotMessage;
use App\Models\Notification;
use App\Models\Repair;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class WorkflowWebhookController extends Controller
{
    /**
     * Handle chatbot response from n8n
     */
    public function handleChatbotResponse(Request $request): JsonResponse
    {
        try {
            $data = $request->validate([
                'session_id' => 'required|string',
                'user_id' => 'required|integer',
                'message' => 'required|string',
                'action' => 'nullable|string',
                'metadata' => 'nullable|array',
            ]);

            // Save bot message
            ChatbotMessage::create([
                'chatbot_session_id' => (int)$data['session_id'],
                'message' => $data['message'],
                'is_user' => false,
                'metadata' => json_encode($data['metadata'] ?? []),
            ]);

            // Create notification if action requires it
            if (isset($data['action']) && in_array($data['action'], ['repair_update', 'booking_confirm', 'appointment_reminder'])) {
                Notification::create([
                    'user_id' => $data['user_id'],
                    'type' => $data['action'],
                    'message' => $data['message'],
                    'data' => json_encode($data['metadata'] ?? []),
                    'read_at' => null,
                ]);
            }

            Log::info('Chatbot response processed', ['session_id' => $data['session_id']]);

            return response()->json([
                'success' => true,
                'message' => 'Response processed',
            ]);
        } catch (\Exception $e) {
            Log::error('Chatbot response webhook error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    /**
     * Handle repair status update from n8n
     */
    public function handleRepairStatusUpdate(Request $request): JsonResponse
    {
        try {
            $data = $request->validate([
                'repair_id' => 'required|integer|exists:repairs,id',
                'status' => 'required|string',
                'user_id' => 'required|integer',
                'message' => 'nullable|string',
            ]);

            $repair = Repair::find($data['repair_id']);
            
            if ($repair && $repair->user_id == $data['user_id']) {
                $repair->update(['status' => $data['status']]);

                // Create notification
                Notification::create([
                    'user_id' => $data['user_id'],
                    'type' => 'repair_status_update',
                    'title' => "Repair #{$repair->id} - Status Update",
                    'message' => $data['message'] ?? "Your repair status has been updated to {$data['status']}",
                    'data' => json_encode(['repair_id' => $repair->id, 'status' => $data['status']]),
                ]);
            }

            Log::info('Repair status updated', ['repair_id' => $data['repair_id']]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Repair status update webhook error: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }

    /**
     * Handle booking confirmation from n8n
     */
    public function handleBookingConfirmation(Request $request): JsonResponse
    {
        try {
            $data = $request->validate([
                'appointment_id' => 'required|integer|exists:appointments,id',
                'user_id' => 'required|integer',
                'confirmation_code' => 'nullable|string',
                'message' => 'nullable|string',
            ]);

            $appointment = Appointment::find($data['appointment_id']);

            if ($appointment && $appointment->user_id == $data['user_id']) {
                $appointment->update([
                    'status' => 'confirmed',
                    'confirmation_code' => $data['confirmation_code'],
                ]);

                Notification::create([
                    'user_id' => $data['user_id'],
                    'type' => 'booking_confirmed',
                    'title' => 'Booking Confirmed',
                    'message' => $data['message'] ?? "Your appointment has been confirmed",
                    'data' => json_encode([
                        'appointment_id' => $appointment->id,
                        'confirmation_code' => $data['confirmation_code'],
                    ]),
                ]);
            }

            Log::info('Booking confirmed', ['appointment_id' => $data['appointment_id']]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Booking confirmation webhook error: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }

    /**
     * Handle appointment notifications
     */
    public function handleAppointmentNotification(Request $request): JsonResponse
    {
        try {
            $data = $request->validate([
                'appointment_id' => 'required|integer|exists:appointments,id',
                'user_id' => 'required|integer',
                'notification_type' => 'required|string',
                'message' => 'required|string',
            ]);

            Notification::create([
                'user_id' => $data['user_id'],
                'type' => 'appointment_' . $data['notification_type'],
                'message' => $data['message'],
                'data' => json_encode(['appointment_id' => $data['appointment_id']]),
            ]);

            Log::info('Appointment notification sent', ['appointment_id' => $data['appointment_id']]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Appointment notification webhook error: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }

    /**
     * Handle product recommendation
     */
    public function handleProductRecommendation(Request $request): JsonResponse
    {
        try {
            $data = $request->validate([
                'user_id' => 'required|integer',
                'products' => 'required|array',
                'message' => 'nullable|string',
            ]);

            Notification::create([
                'user_id' => $data['user_id'],
                'type' => 'product_recommendation',
                'message' => $data['message'] ?? 'New product recommendations available',
                'data' => json_encode(['products' => $data['products']]),
            ]);

            Log::info('Product recommendation created', ['user_id' => $data['user_id']]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Product recommendation webhook error: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }

    /**
     * Handle support ticket creation
     */
    public function handleSupportTicket(Request $request): JsonResponse
    {
        try {
            $data = $request->validate([
                'user_id' => 'required|integer',
                'issue' => 'required|string',
                'description' => 'required|string',
                'ticket_id' => 'nullable|string',
                'priority' => 'nullable|string',
            ]);

            Notification::create([
                'user_id' => $data['user_id'],
                'type' => 'support_ticket_created',
                'title' => 'Support Ticket Created',
                'message' => "Your support ticket has been created: {$data['issue']}",
                'data' => json_encode([
                    'ticket_id' => $data['ticket_id'],
                    'issue' => $data['issue'],
                    'priority' => $data['priority'] ?? 'medium',
                ]),
            ]);

            Log::info('Support ticket created', ['user_id' => $data['user_id'], 'ticket_id' => $data['ticket_id'] ?? 'N/A']);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Support ticket webhook error: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 400);
        }
    }

    /**
     * Health check endpoint for n8n
     */
    public function healthCheck(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'status' => 'healthy',
            'timestamp' => now()->toIso8601String(),
        ]);
    }
}
