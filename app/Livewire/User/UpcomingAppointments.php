<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Carbon\Carbon;

#[Layout('layouts.user')]
#[Title('Upcoming Appointments | Repairmax')]
class UpcomingAppointments extends Component
{
    public $selectedAppointment = null;
    public $showRescheduleModal = false;
    public $showEditModal = false;
    public $rescheduleDate = null;
    public $rescheduleTime = null;

    public int $calendar_week_offset = 0;
    public ?int $selected_index = null;
    public array $available_days = [];
    public $available_slots = ['09:00', '11:00', '13:00', '15:00', '17:00'];

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
                    
                    if ($this->selectedAppointment) {
                        $query->where('id', '!=', $this->selectedAppointment->id);
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

        // Auto-sync selected_index based on rescheduleDate
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
        
        // Restore original appointment time if selecting the original date
        if ($this->selectedAppointment && \Carbon\Carbon::parse($this->selectedAppointment->pref_date)->format('Y-m-d') === $this->rescheduleDate) {
            $this->rescheduleTime = \Carbon\Carbon::parse($this->selectedAppointment->pref_time)->format('H:i');
        } else {
            $this->rescheduleTime = '';
        }
    }

    public function selectRescheduleTime(string $time)
    {
        $this->rescheduleTime = $time;
    }
    public $editDeviceBrand = null;
    public $editDeviceModel = null;
    public $editFaultCategory = null;
    public $editDescription = null;

    public function cancelAppointment($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $appointment = $user->appointments()->findOrFail($id);

        // Check if appointment is more than 1 hour in the future
        $appointmentDateTime = Carbon::parse($appointment->pref_date . ' ' . $appointment->pref_time);
        $hoursUntilAppointment = $appointmentDateTime->diffInHours(now(), false);

        if ($hoursUntilAppointment <= 1) {
            session()->flash('error', 'Appointments can only be cancelled at least 1 hour before the scheduled time.');
            return;
        }

        $appointment->update(['status' => 'Cancelled']);

        session()->flash('message', 'Appointment cancelled successfully.');
        $this->dispatch('refresh-appointments');
    }

    public function openEdit($id)
    {
        $this->dispatch('notify', message: 'Appointments cannot be edited after booking. Please cancel and create a new appointment if needed.', type: 'error');
        return;
    }

    public function saveEdit()
    {
        // Editing is disabled - appointments are read-only after booking
        return;
    }



    public function openReschedule($id)
    {
        $this->dispatch('notify', message: 'Appointments cannot be rescheduled after booking. Please cancel and create a new appointment if needed.', type: 'error');
        return;
    }

    public function saveReschedule()
    {
        // Rescheduling is disabled - appointments are read-only after booking
        return;

        $this->showRescheduleModal = false;
        session()->flash('message', 'Appointment rescheduled successfully.');
        $this->dispatch('refresh-appointments');
    }

    public function closeModals()
    {
        $this->showRescheduleModal = false;
        $this->showEditModal = false;
        $this->selectedAppointment = null;
    }

    public function render()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Get appointments that are Pending or In Progress
        $appointments = $user->appointments()
            ->whereIn('status', ['Pending', 'In Progress', 'Approved'])
            ->orderBy('pref_date', 'asc')
            ->get();

        return view('livewire.user.upcoming-appointments', [
            'appointments' => $appointments
        ]);
    }
}
