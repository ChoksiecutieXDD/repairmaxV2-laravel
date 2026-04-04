<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use App\Models\Message;
use App\Models\User;

#[Layout('components.layouts.admin')]
#[Title('Messages | Repairmax')]
class Messages extends Component
{
    use WithPagination;

    public $selectedMessage = null;
    public $replyMessage = '';
    public $searchTerm = '';

    public function mount()
    {
        // Load messages targeted at admin
    }

    public function getMessages()
    {
        return Message::with('user')
            ->where(function ($query) {
                $query->whereNull('admin_id')
                    ->orWhere('admin_id', auth()->id());
            })
            ->when($this->searchTerm, function ($query) {
                $query->where('subject', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('message', 'like', '%' . $this->searchTerm . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . $this->searchTerm . '%')
                            ->orWhere('email', 'like', '%' . $this->searchTerm . '%');
                    });
            })
            ->orderBy('admin_read', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function selectMessage($messageId)
    {
        $this->selectedMessage = Message::find($messageId);
        if ($this->selectedMessage && !$this->selectedMessage->admin_read) {
            $this->selectedMessage->update([
                'admin_read' => true,
                'admin_read_at' => now(),
            ]);
        }
    }

    public function closeMessage()
    {
        $this->selectedMessage = null;
        $this->replyMessage = '';
    }

    public function sendReply()
    {
        if (!$this->selectedMessage || empty(trim($this->replyMessage))) {
            return;
        }

        // Create a new message for the reply
        Message::create([
            'user_id' => $this->selectedMessage->user_id,
            'admin_id' => auth()->id(),
            'subject' => 'Re: ' . $this->selectedMessage->subject,
            'message' => $this->replyMessage,
            'admin_read' => true,
            'admin_read_at' => now(),
        ]);

        $this->replyMessage = '';
        $this->dispatch('messageAdded');
    }

    public function deleteMessage($messageId)
    {
        Message::find($messageId)?->delete();
        if ($this->selectedMessage?->id === $messageId) {
            $this->closeMessage();
        }
    }

    public function render()
    {
        return view('livewire.admin.messages', [
            'messages' => $this->getMessages(),
        ]);
    }
}

