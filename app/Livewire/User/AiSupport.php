<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\ChatbotSession;
use App\Models\ChatbotMessage;
use Illuminate\Support\Facades\Http;

#[Layout('layouts.user')]
#[Title('AI Support Assistant | Repairmax')]
class AiSupport extends Component
{
    public $newMessage = '';
    public $messages = [];
    public $isTyping = false;
    public ?int $currentSessionId = null;

    public function mount()
    {
        // Try to load the latest session or start a new one
        $latestSession = ChatbotSession::where('user_id', Auth::id())->latest()->first();
        
        if ($latestSession) {
            $this->loadSession($latestSession->id);
        } else {
            $this->startNewChat();
        }
    }

    public function startNewChat()
    {
        $this->currentSessionId = null;
        $this->messages = [];
        
        // Initial greeting from the bot (not saved to DB until session starts)
        $this->messages[] = [
            'role' => 'assistant',
            'content' => 'Hello, ' . (Auth::user()->first_name ?? 'there') . '! I am Maxie, your Repairmax assistant. How can I help you today?',
            'time' => now()->format('h:i A'),
        ];
    }

    public function loadSession(int $sessionId)
    {
        $session = ChatbotSession::where('user_id', Auth::id())->with('messages')->findOrFail($sessionId);
        $this->currentSessionId = $session->id;
        
        $this->messages = $session->messages->map(function($msg) {
            return [
                'role' => $msg->role,
                'content' => $msg->content,
                'time' => $msg->created_at->format('h:i A'),
            ];
        })->toArray();
        
        if (empty($this->messages)) {
            $this->startNewChat();
        }
        
        $this->dispatch('scroll-to-bottom');
    }

    public function deleteSession(int $sessionId)
    {
        ChatbotSession::where('user_id', Auth::id())->findOrFail($sessionId)->delete();
        
        if ($this->currentSessionId == $sessionId) {
            $this->mount();
        }
    }

    public function sendMessage()
    {
        if (trim($this->newMessage) == '') return;

        // Ensure we have a session
        if (!$this->currentSessionId) {
            $session = ChatbotSession::create([
                'user_id' => Auth::id(),
                'title' => substr($this->newMessage, 0, 30) . (strlen($this->newMessage) > 30 ? '...' : '')
            ]);
            $this->currentSessionId = $session->id;
        }

        // Save user message
        ChatbotMessage::create([
            'chatbot_session_id' => $this->currentSessionId,
            'role' => 'user',
            'content' => $this->newMessage,
        ]);

        $userMsg = $this->newMessage;
        $this->messages[] = [
            'role' => 'user',
            'content' => $userMsg,
            'time' => now()->format('h:i A'),
        ];

        $this->newMessage = '';
        $this->generateBotResponse($userMsg);
    }

    private function generateBotResponse(string $text)
    {
        $this->isTyping = true;
        
        try {
            $n8nWebhookUrl = env('N8N_WEBHOOK_URL', 'http://localhost:5678/webhook-test/chatbot');

            $response = Http::asJson()->withHeaders([
                'X-N8N-SECRET' => env('N8N_WEBHOOK_SECRET', 'repairmax_secret_123'),
            ])->post($n8nWebhookUrl, [
                'message' => $text,
                'user_id' => Auth::id() ?? 'anonymous',
                'timestamp' => now()->toIso8601String(),
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $reply = $data['reply'] ?? $data['output'] ?? "I'm here, but I'm having trouble thinking clearly.";
            } else {
                $reply = "I'm having trouble connecting to my brain right now.";
            }
        } catch (\Exception $e) {
            $reply = "System error. Please try again later.";
        }

        // Save bot response
        ChatbotMessage::create([
            'chatbot_session_id' => $this->currentSessionId,
            'role' => 'assistant',
            'content' => $reply,
        ]);

        $this->messages[] = [
            'role' => 'assistant',
            'content' => $reply,
            'time' => now()->format('h:i A'),
        ];

        $this->isTyping = false;
        $this->dispatch('scroll-to-bottom');
    }

    public function render()
    {
        return view('livewire.user.ai-support', [
            'history' => ChatbotSession::where('user_id', Auth::id())
                ->latest()
                ->take(15)
                ->get()
        ]);
    }
}
