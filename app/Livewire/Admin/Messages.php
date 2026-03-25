<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Messages | Repairmax')]
class Messages extends Component
{
    public $searchTerm = '';
    public $selectedMessage = null;

    public function selectMessage($id)
    {
        $this->selectedMessage = $id;
    }

    public function render()
    {
        $messages = [
            ['id' => 1, 'from' => 'John Doe', 'email' => 'john@example.com', 'subject' => 'Appointment Inquiry', 'preview' => 'I would like to book an appointment for...', 'date' => '2026-03-26', 'time' => '10:30 AM', 'read' => false],
            ['id' => 2, 'from' => 'Jane Smith', 'email' => 'jane@example.com', 'subject' => 'Repair Status', 'preview' => 'Could you provide an update on my iPhone repair?', 'date' => '2026-03-25', 'time' => '02:15 PM', 'read' => true],
            ['id' => 3, 'from' => 'Mike Johnson', 'email' => 'mike@example.com', 'subject' => 'Payment Issue', 'preview' => 'I was charged twice for my repair service...', 'date' => '2026-03-24', 'time' => '11:00 AM', 'read' => true],
        ];

        return view('livewire.admin.messages', [
            'messages' => $messages,
        ]);
    }
}
