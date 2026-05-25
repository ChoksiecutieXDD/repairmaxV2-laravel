<?php

namespace App\Http\Controllers\N8n;

use App\Http\Controllers\Controller;
use App\Models\ChatbotSession;
use App\Models\ChatbotMessage;
use App\Services\N8nService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ChatbotController extends Controller
{
    private N8nService $n8nService;

    public function __construct(N8nService $n8nService)
    {
        $this->n8nService = $n8nService;
    }

    /**
     * Send message to chatbot
     */
    public function sendMessage(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:2000',
            'session_id' => 'nullable|integer|exists:chatbot_sessions,id',
        ]);

        $userId = auth()->id();
        $sessionId = $validated['session_id'] ?? null;

        // Create or get session
        if (!$sessionId) {
            $session = ChatbotSession::create([
                'user_id' => $userId,
                'title' => substr($validated['message'], 0, 50),
            ]);
            $sessionId = $session->id;
        }

        // Save user message
        ChatbotMessage::create([
            'chatbot_session_id' => $sessionId,
            'message' => $validated['message'],
            'is_user' => true,
        ]);

        // Send to n8n
        $result = $this->n8nService->sendChatbotMessage(
            $validated['message'],
            $userId,
            (string)$sessionId
        );

        if (!$result['success']) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to process your message. Please try again.',
                'error' => $result['error'] ?? 'Unknown error',
            ], 500);
        }

        // Extract response from n8n result
        $botResponse = $result['data']['message'] ?? 'I understood your message. Let me process that for you.';

        // Save bot response
        ChatbotMessage::create([
            'chatbot_session_id' => $sessionId,
            'message' => $botResponse,
            'is_user' => false,
        ]);

        return response()->json([
            'success' => true,
            'session_id' => $sessionId,
            'response' => $botResponse,
            'metadata' => $result['data']['metadata'] ?? [],
        ]);
    }

    /**
     * Get conversation messages
     */
    public function getMessages($sessionId): JsonResponse
    {
        $session = ChatbotSession::findOrFail($sessionId);
        
        $this->authorize('view', $session);

        $messages = $session->messages()
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(fn($msg) => [
                'id' => $msg->id,
                'message' => $msg->message,
                'is_user' => $msg->is_user,
                'created_at' => $msg->created_at,
            ]);

        return response()->json([
            'success' => true,
            'session' => [
                'id' => $session->id,
                'title' => $session->title,
                'created_at' => $session->created_at,
            ],
            'messages' => $messages,
        ]);
    }

    /**
     * Create new session
     */
    public function createSession(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
        ]);

        $session = ChatbotSession::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'] ?? 'New Conversation',
        ]);

        return response()->json([
            'success' => true,
            'session' => [
                'id' => $session->id,
                'title' => $session->title,
                'created_at' => $session->created_at,
            ],
        ], 201);
    }

    /**
     * Get user sessions
     */
    public function getSessions(): JsonResponse
    {
        $sessions = ChatbotSession::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->with(['messages' => function ($query) {
                $query->latest()->limit(1);
            }])
            ->paginate(15);

        return response()->json([
            'success' => true,
            'sessions' => $sessions->items(),
            'pagination' => [
                'current_page' => $sessions->currentPage(),
                'last_page' => $sessions->lastPage(),
                'total' => $sessions->total(),
            ],
        ]);
    }

    /**
     * Delete session
     */
    public function deleteSession($sessionId): JsonResponse
    {
        $session = ChatbotSession::findOrFail($sessionId);
        
        $this->authorize('delete', $session);

        $session->messages()->delete();
        $session->delete();

        return response()->json([
            'success' => true,
            'message' => 'Session deleted successfully.',
        ]);
    }
}
