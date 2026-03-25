<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.user')]
#[Title('AI Support Assistant | Repairmax')]
class AiSupport extends Component
{
    public $newMessage = '';
    public $messages = [];

    public function mount()
    {
        // Initial greeting from the bot
        $this->messages[] = [
            'role' => 'assistant',
            'content' => 'Hello, ' . (Auth::user()->first_name ?? 'there') . '! How can I assist you with your device repair today?',
            'time' => now()->format('h:i A'),
            'is_ticket' => false,
        ];
    }

    public function sendMessage()
    {
        // 1. Validate the input
        $this->validate([
            'newMessage' => 'required|string|max:1000',
        ]);

        // 2. Push user message to the array
        $this->messages[] = [
            'role' => 'user',
            'content' => $this->newMessage,
            'time' => now()->format('h:i A'),
            'is_ticket' => false,
        ];

        $userText = $this->newMessage;

        // 3. Clear the input field
        $this->reset('newMessage');

        // 4. Trigger the AI response
        $this->generateBotResponse($userText);
    }

    private function generateBotResponse($text)
    {
        // Simple keyword logic for demonstration
        $content = "I'm a beta bot! I've logged your request, and a human agent will review it shortly.";
        $isTicket = false;

        if (stripos($text, 'screen') !== false || stripos($text, 'crack') !== false) {
            $content = "Since your screen is damaged, it sounds like you need a full assembly replacement. Would you like me to open a support ticket for a drop-off?";
        } elseif (stripos($text, 'ticket') !== false || stripos($text, 'yes') !== false) {
            $content = "I've created your ticket. Our technicians have been notified. You can proceed to book your drop-off time below.";
            $isTicket = true;
        }

        $this->messages[] = [
            'role' => 'assistant',
            'content' => $content,
            'time' => now()->format('h:i A'),
            'is_ticket' => $isTicket,
        ];
    }

    public function render()
    {
        return view('livewire.user.ai-support');
    }
}
