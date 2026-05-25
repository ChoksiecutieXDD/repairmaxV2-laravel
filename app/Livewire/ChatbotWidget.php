<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ChatbotSession;
use App\Models\ChatbotMessage;
use App\Services\N8nService;
use Illuminate\Support\Facades\Auth;

class ChatbotWidget extends Component
{
    public $sessions = [];
    public $currentSession = null;
    public $messages = [];
    public $newMessage = '';
    public $isLoading = false;
    public $showHistory = false;

    protected $n8nService;

    public function mount()
    {
        $this->n8nService = app(N8nService::class);
        $this->loadSessions();
    }

    public function loadSessions()
    {
        $this->sessions = ChatbotSession::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->toArray();
    }

    public function createSession()
    {
        $session = ChatbotSession::create([
            'user_id' => Auth::id(),
            'title' => 'New Conversation',
        ]);

        $this->currentSession = $session->id;
        $this->messages = [];
        $this->loadSessions();
        $this->dispatch('session-created', sessionId: $session->id);
    }

    public function selectSession($sessionId)
    {
        $session = ChatbotSession::where('user_id', Auth::id())
            ->findOrFail($sessionId);

        $this->currentSession = $session->id;
        $this->loadMessages();
    }

    public function loadMessages()
    {
        if (!$this->currentSession) {
            return;
        }

        $this->messages = ChatbotMessage::where('chatbot_session_id', $this->currentSession)
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(fn($msg) => [
                'id' => $msg->id,
                'message' => $msg->message,
                'is_user' => $msg->is_user,
                'created_at' => $msg->created_at->format('H:i'),
                'metadata' => json_decode($msg->metadata ?? '{}', true),
            ])
            ->toArray();
    }

    public function sendMessage()
    {
        if (empty(trim($this->newMessage))) {
            return;
        }

        if (!$this->currentSession) {
            $this->createSession();
        }

        $this->isLoading = true;
        $message = $this->newMessage;
        $this->newMessage = '';

        // Add user message to UI
        $this->messages[] = [
            'message' => $message,
            'is_user' => true,
            'created_at' => now()->format('H:i'),
        ];

        // Send to n8n
        $result = $this->n8nService->sendChatbotMessage(
            $message,
            Auth::id(),
            (string)$this->currentSession
        );

        if ($result['success']) {
            $response = $result['data']['message'] ?? 'I received your message and am processing it.';

            // Save messages to DB
            ChatbotMessage::create([
                'chatbot_session_id' => $this->currentSession,
                'message' => $message,
                'is_user' => true,
            ]);

            ChatbotMessage::create([
                'chatbot_session_id' => $this->currentSession,
                'message' => $response,
                'is_user' => false,
                'metadata' => json_encode($result['data']['metadata'] ?? []),
            ]);

            $this->messages[] = [
                'message' => $response,
                'is_user' => false,
                'created_at' => now()->format('H:i'),
                'metadata' => $result['data']['metadata'] ?? [],
            ];

            $this->dispatch('message-sent');
        } else {
            $this->messages[] = [
                'message' => '❌ Failed to process your message. Please try again.',
                'is_user' => false,
                'created_at' => now()->format('H:i'),
            ];
        }

        $this->isLoading = false;
    }

    public function deleteSession($sessionId)
    {
        ChatbotSession::where('user_id', Auth::id())
            ->findOrFail($sessionId)
            ->delete();

        if ($this->currentSession == $sessionId) {
            $this->currentSession = null;
            $this->messages = [];
        }

        $this->loadSessions();
    }

    public function toggleHistory()
    {
        $this->showHistory = !$this->showHistory;
    }

    public function render()
    {
        return view('livewire.chatbot-widget', [
            'sessions' => $this->sessions,
            'currentSession' => $this->currentSession,
            'messages' => $this->messages,
            'isLoading' => $this->isLoading,
            'showHistory' => $this->showHistory,
        ]);
    }
}
