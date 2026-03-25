<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('components.layouts.admin')]
#[Title('Appointments | Repairmax')]
class Appointment extends Component
{
    use WithPagination;

    public $searchTerm = '';
    public $filterStatus = '';
    public $sortBy = 'created_at';
    public $sortDirection = 'desc';

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        $this->sortDirection = $this->sortBy === $field 
            ? ($this->sortDirection === 'asc' ? 'desc' : 'asc')
            : 'asc';
        $this->sortBy = $field;
    }

    public function render()
    {
        // Mock data for appointments - replace with real model later
        $appointments = [
            ['id' => 1, 'user' => 'John Doe', 'device' => 'iPhone 14 Pro', 'service' => 'Screen Repair', 'date' => '2026-03-25', 'status' => 'Completed', 'amount' => '₱2,500'],
            ['id' => 2, 'user' => 'Jane Smith', 'device' => 'Samsung A50', 'service' => 'Battery Replacement', 'date' => '2026-03-26', 'status' => 'In Progress', 'amount' => '₱1,800'],
            ['id' => 3, 'user' => 'Mike Johnson', 'device' => 'iPad Air', 'service' => 'Screen Replacement', 'date' => '2026-03-27', 'status' => 'Pending', 'amount' => '₱3,200'],
        ];

        return view('livewire.admin.appointment', [
            'appointments' => $appointments,
        ]);
    }
}
