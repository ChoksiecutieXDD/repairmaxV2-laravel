<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class N8nService
{
    private string $baseUrl;
    private string $webhookUrl;
    private int $timeout = 30;

    public function __construct()
    {
        $this->baseUrl = env('N8N_HOST', 'http://localhost:5678');
        $this->webhookUrl = env('N8N_WEBHOOK_URL', $this->baseUrl);
    }

    /**
     * Send message to n8n chatbot workflow
     */
    public function sendChatbotMessage(string $message, int $userId, string $sessionId = null): array
    {
        try {
            $payload = [
                'message' => $message,
                'user_id' => $userId,
                'session_id' => $sessionId,
                'timestamp' => now()->toIso8601String(),
            ];

            $response = Http::timeout($this->timeout)
                ->post("{$this->webhookUrl}/webhook/chatbot-message", $payload);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'data' => $response->json(),
                ];
            }

            return [
                'success' => false,
                'error' => 'N8n webhook failed',
                'status' => $response->status(),
            ];
        } catch (Exception $e) {
            Log::error('N8nService error: ' . $e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Trigger repair status workflow
     */
    public function triggerRepairStatus(int $repairId, int $userId): array
    {
        return $this->triggerWorkflow('repair-status-check', [
            'repair_id' => $repairId,
            'user_id' => $userId,
            'triggered_at' => now()->toIso8601String(),
        ]);
    }

    /**
     * Trigger booking confirmation workflow
     */
    public function triggerBookingConfirmation(int $appointmentId): array
    {
        return $this->triggerWorkflow('booking-confirmation', [
            'appointment_id' => $appointmentId,
            'triggered_at' => now()->toIso8601String(),
        ]);
    }

    /**
     * Trigger appointment scheduling workflow
     */
    public function triggerAppointmentScheduling(int $userId, array $data): array
    {
        return $this->triggerWorkflow('appointment-scheduling', array_merge([
            'user_id' => $userId,
            'triggered_at' => now()->toIso8601String(),
        ], $data));
    }

    /**
     * Get product recommendations
     */
    public function getProductRecommendations(int $userId, string $deviceType = null): array
    {
        return $this->triggerWorkflow('product-recommendations', [
            'user_id' => $userId,
            'device_type' => $deviceType,
            'triggered_at' => now()->toIso8601String(),
        ]);
    }

    /**
     * Trigger support ticket workflow
     */
    public function triggerSupportTicket(int $userId, string $issue, string $description): array
    {
        return $this->triggerWorkflow('support-ticket', [
            'user_id' => $userId,
            'issue' => $issue,
            'description' => $description,
            'triggered_at' => now()->toIso8601String(),
        ]);
    }

    /**
     * Generic workflow trigger
     */
    private function triggerWorkflow(string $workflowName, array $data): array
    {
        try {
            $response = Http::timeout($this->timeout)
                ->post("{$this->webhookUrl}/webhook/{$workflowName}", $data);

            if ($response->successful()) {
                return [
                    'success' => true,
                    'workflow' => $workflowName,
                    'data' => $response->json(),
                ];
            }

            return [
                'success' => false,
                'workflow' => $workflowName,
                'error' => 'Workflow trigger failed',
                'status' => $response->status(),
            ];
        } catch (Exception $e) {
            Log::error("N8n workflow '{$workflowName}' error: " . $e->getMessage());
            return [
                'success' => false,
                'workflow' => $workflowName,
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Health check for n8n connection
     */
    public function healthCheck(): bool
    {
        try {
            $response = Http::timeout(5)
                ->get("{$this->baseUrl}/api/v1/health");

            return $response->successful();
        } catch (Exception $e) {
            Log::warning('N8n health check failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get webhook URL for frontend
     */
    public function getWebhookUrl(string $workflow): string
    {
        return "{$this->webhookUrl}/webhook/{$workflow}";
    }
}
