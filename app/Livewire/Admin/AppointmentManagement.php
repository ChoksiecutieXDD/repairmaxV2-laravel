<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Appointment Management | Repairmax')]
class AppointmentManagement extends Component
{
    use WithPagination;

    public $searchTerm = '';
    public $filterStatus = '';

    public function render()
    {
        $appointments = [
            ['id' => 1, 'user' => 'John Doe', 'device' => 'iPhone 14 Pro', 'service' => 'Screen Repair', 'date' => '2026-03-25', 'time' => '10:00 AM', 'status' => 'Completed', 'technician' => 'Alex'],
            ['id' => 2, 'user' => 'Jane Smith', 'device' => 'Samsung A50', 'service' => 'Battery Replacement', 'date' => '2026-03-26', 'time' => '02:00 PM', 'status' => 'In Progress', 'technician' => 'Bob'],
            ['id' => 3, 'user' => 'Mike Johnson', 'device' => 'iPad Air', 'service' => 'Screen Replacement', 'date' => '2026-03-27', 'time' => '11:00 AM', 'status' => 'Pending', 'technician' => 'Unassigned'],
        ];

        return view('livewire.admin.appointment-management', [
            'appointments' => $appointments,
        ]);
    }
}
