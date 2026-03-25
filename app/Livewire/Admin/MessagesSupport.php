<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.admin')]
#[Title('Support Tickets | Repairmax')]
class MessagesSupport extends Component
{
    public $searchTerm = '';
    public $filterStatus = '';

    public function render()
    {
        $tickets = [
            ['id' => 'TKT-001', 'customer' => 'John Doe', 'subject' => 'Device not turning on', 'priority' => 'High', 'status' => 'Open', 'created' => '2026-03-24', 'updated' => '2026-03-26'],
            ['id' => 'TKT-002', 'customer' => 'Jane Smith', 'subject' => 'Warranty claim inquiry', 'priority' => 'Medium', 'status' => 'In Progress', 'created' => '2026-03-23', 'updated' => '2026-03-25'],
            ['id' => 'TKT-003', 'customer' => 'Mike Johnson', 'subject' => 'Refund request', 'priority' => 'High', 'status' => 'Pending', 'created' => '2026-03-22', 'updated' => '2026-03-26'],
            ['id' => 'TKT-004', 'customer' => 'Sarah Williams', 'subject' => 'Appointment reschedule', 'priority' => 'Low', 'status' => 'Resolved', 'created' => '2026-03-20', 'updated' => '2026-03-22'],
        ];

        return view('livewire.admin.messages-support', [
            'tickets' => $tickets,
        ]);
    }
}
