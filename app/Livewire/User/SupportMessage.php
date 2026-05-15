<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Notification;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.user')]
#[Title('Send Support Message | Repairmax')]
class SupportMessage extends Component
{
    public $subject = '';
    public $message = '';
    public $messages = [];

    public function mount()
    {
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $userId = Auth::id();
        $this->messages = Message::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->toArray();
    }

    protected $rules = [
        'subject' => 'required|string|max:255',
        'message' => 'required|string|max:2000',
    ];

    public function sendMessage()
    {
        $this->validate();

        // Create the message
        $supportMessage = Message::create([
            'user_id' => Auth::id(),
            'subject' => $this->subject,
            'message' => $this->message,
            'is_read' => false,
            'admin_read' => false,
        ]);

        // Notify all admins
        $admins = User::where('role', 'admin')->get();
        $userFullName = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'admin_id' => $admin->id,
                'title' => 'New Support Message',
                'message' => $userFullName . ' sent a support message: ' . $this->subject,
                'type' => 'support_message',
                'related_model' => 'Message',
                'related_id' => $supportMessage->id,
                'is_read' => false,
            ]);
        }

        // Reset form
        $this->subject = '';
        $this->message = '';
        
        // Reload messages
        $this->loadMessages();
        
        $this->dispatch('toast', message: 'Support message sent successfully! Our team will get back to you soon.', type: 'success');
    }

    public function deleteMessage($messageId)
    {
        Message::where('id', $messageId)
            ->where('user_id', Auth::id())
            ->delete();
        
        $this->loadMessages();
    }

    public function render()
    {
        return view('livewire.user.support-message');
    }
}
