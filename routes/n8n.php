<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\N8n\ChatbotController;
use App\Http\Controllers\N8n\WorkflowWebhookController;

// Chatbot endpoints
Route::middleware(['auth:sanctum', 'throttle:60,1'])->group(function () {
    // Send message to chatbot
    Route::post('/chatbot/message', [ChatbotController::class, 'sendMessage']);
    
    // Get conversation history
    Route::get('/chatbot/sessions/{sessionId}/messages', [ChatbotController::class, 'getMessages']);
    
    // Create new session
    Route::post('/chatbot/sessions', [ChatbotController::class, 'createSession']);
    
    // Get user sessions
    Route::get('/chatbot/sessions', [ChatbotController::class, 'getSessions']);
    
    // Delete session
    Route::delete('/chatbot/sessions/{sessionId}', [ChatbotController::class, 'deleteSession']);
});

// N8n webhook endpoints (for n8n to call Laravel)
Route::prefix('webhooks/n8n')->group(function () {
    // Chatbot response callback
    Route::post('/chatbot-response', [WorkflowWebhookController::class, 'handleChatbotResponse']);
    
    // Repair status update
    Route::post('/repair-status-update', [WorkflowWebhookController::class, 'handleRepairStatusUpdate']);
    
    // Booking confirmation callback
    Route::post('/booking-confirmation', [WorkflowWebhookController::class, 'handleBookingConfirmation']);
    
    // Appointment notification
    Route::post('/appointment-notification', [WorkflowWebhookController::class, 'handleAppointmentNotification']);
    
    // Product recommendation
    Route::post('/product-recommendation', [WorkflowWebhookController::class, 'handleProductRecommendation']);
    
    // Support ticket creation
    Route::post('/support-ticket', [WorkflowWebhookController::class, 'handleSupportTicket']);
    
    // Health check
    Route::post('/health', [WorkflowWebhookController::class, 'healthCheck']);
});
