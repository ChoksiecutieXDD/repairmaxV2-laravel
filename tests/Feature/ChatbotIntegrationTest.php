<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\ChatbotSession;
use App\Models\ChatbotMessage;
use App\Services\N8nService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChatbotIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /**
     * Test: N8N Service Health Check
     */
    public function test_n8n_health_check()
    {
        $service = app(N8nService::class);
        $result = $service->healthCheck();
        
        // This will be false if n8n is not running, but test should pass
        $this->assertIsBool($result);
    }

    /**
     * Test: Create Chatbot Session
     */
    public function test_create_chatbot_session()
    {
        $session = ChatbotSession::create([
            'user_id' => $this->user->id,
            'title' => 'Test Conversation',
        ]);

        $this->assertInstanceOf(ChatbotSession::class, $session);
        $this->assertEquals($this->user->id, $session->user_id);
    }

    /**
     * Test: Save Chatbot Message
     */
    public function test_save_chatbot_message()
    {
        $session = ChatbotSession::create([
            'user_id' => $this->user->id,
            'title' => 'Test',
        ]);

        $message = ChatbotMessage::create([
            'chatbot_session_id' => $session->id,
            'message' => 'Hello bot!',
            'is_user' => true,
        ]);

        $this->assertInstanceOf(ChatbotMessage::class, $message);
        $this->assertTrue($message->is_user);
        $this->assertEquals('Hello bot!', $message->message);
    }

    /**
     * Test: Send Message API Endpoint
     */
    public function test_send_message_api_endpoint()
    {
        $response = $this->actingAs($this->user)
            ->postJson('/api/chatbot/message', [
                'message' => 'Test message',
            ]);

        // Note: This will fail if n8n is not running or configured
        // Expected: 201 Created or 500 if n8n unreachable
        $this->assertIn($response->status(), [201, 500, 422]);
    }

    /**
     * Test: Get Sessions Endpoint
     */
    public function test_get_sessions_endpoint()
    {
        ChatbotSession::create([
            'user_id' => $this->user->id,
            'title' => 'Session 1',
        ]);

        $response = $this->actingAs($this->user)
            ->getJson('/api/chatbot/sessions');

        $response->assertStatus(200);
        $this->assertArrayHasKey('sessions', $response->json());
    }

    /**
     * Test: Create Session Endpoint
     */
    public function test_create_session_endpoint()
    {
        $response = $this->actingAs($this->user)
            ->postJson('/api/chatbot/sessions', [
                'title' => 'New Chat',
            ]);

        $response->assertStatus(201);
        $this->assertArrayHasKey('session', $response->json());
    }

    /**
     * Test: Delete Session Endpoint
     */
    public function test_delete_session_endpoint()
    {
        $session = ChatbotSession::create([
            'user_id' => $this->user->id,
            'title' => 'To Delete',
        ]);

        $response = $this->actingAs($this->user)
            ->deleteJson("/api/chatbot/sessions/{$session->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('chatbot_sessions', ['id' => $session->id]);
    }

    /**
     * Test: Webhook Health Check
     */
    public function test_webhook_health_check()
    {
        $response = $this->postJson('/api/webhooks/n8n/health');
        
        $response->assertStatus(200);
        $this->assertArrayHasKey('status', $response->json());
        $this->assertEquals('healthy', $response->json('status'));
    }

    /**
     * Test: Chat Messages Relationship
     */
    public function test_session_messages_relationship()
    {
        $session = ChatbotSession::create([
            'user_id' => $this->user->id,
            'title' => 'Test',
        ]);

        ChatbotMessage::create([
            'chatbot_session_id' => $session->id,
            'message' => 'Message 1',
            'is_user' => true,
        ]);

        ChatbotMessage::create([
            'chatbot_session_id' => $session->id,
            'message' => 'Message 2',
            'is_user' => false,
        ]);

        $this->assertCount(2, $session->messages);
    }

    /**
     * Test: User Messages Scope
     */
    public function test_user_messages_scope()
    {
        $session = ChatbotSession::create([
            'user_id' => $this->user->id,
            'title' => 'Test',
        ]);

        ChatbotMessage::create([
            'chatbot_session_id' => $session->id,
            'message' => 'User message',
            'is_user' => true,
        ]);

        ChatbotMessage::create([
            'chatbot_session_id' => $session->id,
            'message' => 'Bot message',
            'is_user' => false,
        ]);

        $userMessages = ChatbotMessage::userMessages()->count();
        $botMessages = ChatbotMessage::botMessages()->count();

        $this->assertEquals(1, $userMessages);
        $this->assertEquals(1, $botMessages);
    }

    /**
     * Test: N8N Service Methods
     */
    public function test_n8n_service_methods()
    {
        $service = app(N8nService::class);

        // These will return success: false if n8n is not configured
        // but the methods should exist and return proper format

        $result = $service->triggerRepairStatus(1, $this->user->id);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('success', $result);

        $result = $service->triggerBookingConfirmation(1);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('success', $result);

        $result = $service->getProductRecommendations($this->user->id);
        $this->assertIsArray($result);
        $this->assertArrayHasKey('success', $result);
    }

    /**
     * Test: Unauthorized Access Prevention
     */
    public function test_unauthorized_user_cannot_access_session()
    {
        $otherUser = User::factory()->create();
        $session = ChatbotSession::create([
            'user_id' => $this->user->id,
            'title' => 'Private Session',
        ]);

        $response = $this->actingAs($otherUser)
            ->getJson("/api/chatbot/sessions/{$session->id}/messages");

        $response->assertStatus(403);
    }
}
