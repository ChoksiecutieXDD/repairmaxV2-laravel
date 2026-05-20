<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.user')]
#[Title('Appointment Details | Repairmax')]
class BookedDetails extends Component
{
    public $appointmentId;
    public $appointment;

    // Modals
    public $showRescheduleModal = false;
    public $showEditModal = false;

    // Edit Fields
    public $editDeviceBrand = null;
    public $editDeviceModel = null;
    public $editFaultCategory = null;
    public $editDescription = null;

    // Reschedule Fields
    public $rescheduleDate = null;
    public $rescheduleTime = null;
    public int $calendar_week_offset = 0;
    public ?int $selected_index = null;
    public array $available_days = [];
    public $available_slots = ['09:00', '11:00', '13:00', '15:00', '17:00'];

    public function mount($id)
    {
        $this->appointmentId = $id;
        $this->loadAppointment();
    }

    public function loadAppointment()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $this->appointment = $user->appointments()->findOrFail($this->appointmentId);
    }

    public function cancelAppointment()
    {
        if ($this->appointment->status !== 'Cancelled') {
            $this->appointment->update(['status' => 'Cancelled']);
            session()->flash('success', 'Appointment cancelled successfully.');
            $this->loadAppointment();
        }
    }

    public function openEdit()
    {
        $this->editDeviceBrand = $this->appointment->device_brand;
        $this->editDeviceModel = $this->appointment->device_model;
        $this->editFaultCategory = $this->appointment->fault_category;
        $this->editDescription = $this->appointment->description;
        $this->showEditModal = true;
    }

    public function saveEdit()
    {
        if (!$this->editDeviceBrand || !$this->editFaultCategory) {
            session()->flash('error', 'Please fill in all required fields.');
            return;
        }

        $this->appointment->update([
            'device_brand' => $this->editDeviceBrand,
            'device_model' => $this->editDeviceModel,
            'fault_category' => $this->editFaultCategory,
            'description' => $this->editDescription,
        ]);

        $this->showEditModal = false;
        session()->flash('success', 'Appointment details updated successfully.');
        $this->loadAppointment();
    }

    public function openReschedule()
    {
        $this->rescheduleDate = \Carbon\Carbon::parse($this->appointment->pref_date)->format('Y-m-d');
        $this->rescheduleTime = \Carbon\Carbon::parse($this->appointment->pref_time)->format('H:i');
        
        $this->calendar_week_offset = 0;
        $this->generateAvailableDays();
        
        $this->selected_index = null;
        foreach ($this->available_days as $idx => $day) {
            if ($day['full'] === $this->rescheduleDate) {
                $this->selected_index = $idx;
                break;
            }
        }
        
        $this->showRescheduleModal = true;
    }

    public function generateAvailableDays()
    {
        $this->available_days = [];
        $date = now()->startOfDay()->addDays($this->calendar_week_offset * 7);
        $found = 0;

        for ($i = 0; $found < 5 && $i < 14; $i++) {
            if (!$date->isWeekend()) {
                $dateStr = $date->format('Y-m-d');
                $slotStatus = [];
                foreach ($this->available_slots as $slot) {
                    $query = Appointment::where('pref_date', $dateStr)
                        ->where('pref_time', 'like', $slot . '%')
                        ->whereIn('status', ['Pending', 'In Progress']);
                    
                    if ($this->appointment) {
                        $query->where('id', '!=', $this->appointment->id);
                    }
                    
                    $count = $query->count();
                    $slotStatus[$slot] = $count;
                }

                $slotsLeftForDay = 0;
                foreach ($this->available_slots as $slot) {
                    if ($slotStatus[$slot] < 1) {
                        $slotsLeftForDay++;
                    }
                }

                $this->available_days[] = [
                    'full'        => $dateStr,
                    'day'         => $date->format('D'),
                    'date'        => $date->format('d'),
                    'month'       => $date->format('M'),
                    'slots_left'  => $slotsLeftForDay,
                    'slot_status' => $slotStatus,
                ];
                $found++;
            }
            $date->addDay();
        }

        $this->selected_index = null;
        if ($this->rescheduleDate) {
            foreach ($this->available_days as $idx => $day) {
                if ($day['full'] === $this->rescheduleDate) {
                    $this->selected_index = $idx;
                    break;
                }
            }
        }
    }

    public function nextWeek()
    {
        $this->calendar_week_offset++;
        $this->generateAvailableDays();
    }

    public function prevWeek()
    {
        if ($this->calendar_week_offset > 0) {
            $this->calendar_week_offset--;
            $this->generateAvailableDays();
        }
    }

    public function selectRescheduleDate(int $index)
    {
        $this->selected_index = $index;
        $this->rescheduleDate = $this->available_days[$index]['full'];
        
        if (\Carbon\Carbon::parse($this->appointment->pref_date)->format('Y-m-d') === $this->rescheduleDate) {
            $this->rescheduleTime = \Carbon\Carbon::parse($this->appointment->pref_time)->format('H:i');
        } else {
            $this->rescheduleTime = '';
        }
    }

    public function selectRescheduleTime(string $time)
    {
        $this->rescheduleTime = $time;
    }

    public function saveReschedule()
    {
        if (!$this->rescheduleDate || !$this->rescheduleTime) {
            session()->flash('error', 'Please select both date and time.');
            return;
        }

        $formattedTime = date("H:i:s", strtotime($this->rescheduleTime));

        $this->appointment->update([
            'pref_date' => $this->rescheduleDate,
            'pref_time' => $formattedTime,
        ]);

        $this->showRescheduleModal = false;
        session()->flash('success', 'Appointment rescheduled successfully.');
        $this->loadAppointment();
    }

    public function closeModals()
    {
        $this->showRescheduleModal = false;
        $this->showEditModal = false;
    }

    public function render()
    {
        return view('livewire.user.booked-details');
    }
}
