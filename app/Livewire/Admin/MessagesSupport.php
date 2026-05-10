<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Support Tickets | Repairmax')]
class MessagesSupport extends Component
{
    public $selectedMessage = null;

    public function viewMessage($id)
    {
        $this->selectedMessage = \App\Models\Message::with('user')->find($id);
        
        if ($this->selectedMessage && !$this->selectedMessage->admin_read) {
            $this->selectedMessage->update([
                'admin_read' => true,
                'admin_read_at' => now(),
            ]);
        }

        $this->dispatch('open-modal', 'view-message');
    }

    public function render()
    {
        return view('livewire.admin.messages-support', [
            'tickets' => \App\Models\Message::with('user')->latest()->get()
        ]);
    }
}
