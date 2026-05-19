<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Appointment as AppointmentModel;

#[Layout('components.layouts.admin')]
#[Title('Appointments | Repairmax')]
class Appointment extends Component
{
    public $search = '';

    public function render()
    {
        // Kunin lahat ng appointments na may filter sa search
        $appointments = AppointmentModel::with('user')
            ->when($this->search, function ($query) {
                $query->where('device_brand', 'like', '%'.$this->search.'%')
                    ->orWhere('device_model', 'like', '%'.$this->search.'%')
                    ->orWhere('tracking_code', 'like', '%'.$this->search.'%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('first_name', 'like', '%'.$this->search.'%')
                            ->orWhere('last_name', 'like', '%'.$this->search.'%')
                            ->orWhere('email', 'like', '%'.$this->search.'%');
                    });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.appointment', compact('appointments'));
    }

    // Navigate to the full appointment details page
    public function viewDetails($id)
    {
        return redirect()->route('admin.appointment.details', ['id' => $id]);
    }
}
