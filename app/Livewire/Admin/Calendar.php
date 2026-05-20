<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Appointment;
use Carbon\Carbon;

#[Layout('components.layouts.admin')]
#[Title('Appointment Calendar | Repairmax')]
class Calendar extends Component
{
    public $currentYear;
    public $currentMonth;
    public $selectedDate = null;
    public $selectedDateAppointments = [];

    // Reschedule/Move Modal State
    public $showRescheduleModal = false;
    public $selectedAppointment = null;
    public $rescheduleDate;
    public $rescheduleTime;

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
        if ($this->selectedAppointment && Carbon::parse($this->selectedAppointment->pref_date)->format('Y-m-d') === $this->rescheduleDate) {
            $this->rescheduleTime = Carbon::parse($this->selectedAppointment->pref_time)->format('H:i');
        } else {
            $this->rescheduleTime = '';
        }
    }

    public function selectRescheduleTime(string $time)
    {
        $this->rescheduleTime = $time;
    }

    public function mount()
    {
        $this->currentYear = now()->year;
        $this->currentMonth = now()->month;
        
        // Auto-select today
        $this->selectDate(now()->format('Y-m-d'));
    }

    public function prevMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->subMonth();
        $this->currentYear = $date->year;
        $this->currentMonth = $date->month;
        $this->selectedDate = null;
        $this->selectedDateAppointments = [];
    }

    public function nextMonth()
    {
        $date = Carbon::create($this->currentYear, $this->currentMonth, 1)->addMonth();
        $this->currentYear = $date->year;
        $this->currentMonth = $date->month;
        $this->selectedDate = null;
        $this->selectedDateAppointments = [];
    }

    public function selectDate($dateStr)
    {
        $this->selectedDate = $dateStr;
        $this->selectedDateAppointments = Appointment::with('user')
            ->whereDate('pref_date', $dateStr)
            ->orderBy('pref_time', 'asc')
            ->get();
    }

    public function openReschedule($id)
    {
        $this->selectedAppointment = Appointment::findOrFail($id);
        $this->rescheduleDate = Carbon::parse($this->selectedAppointment->pref_date)->format('Y-m-d');
        $this->rescheduleTime = Carbon::parse($this->selectedAppointment->pref_time)->format('H:i');
        
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

    public function closeModals()
    {
        $this->showRescheduleModal = false;
        $this->selectedAppointment = null;
    }

    public function saveReschedule()
    {
        $this->validate([
            'rescheduleDate' => 'required|date',
            'rescheduleTime' => 'required',
        ]);

        $this->selectedAppointment->update([
            'pref_date' => $this->rescheduleDate,
            'pref_time' => $this->rescheduleTime,
        ]);

        // Notify user if authenticated
        if ($this->selectedAppointment->user_id) {
            \App\Models\Notification::create([
                'user_id' => $this->selectedAppointment->user_id,
                'admin_id' => auth()->id(),
                'title' => 'Appointment Rescheduled by Admin',
                'message' => "Your appointment has been rescheduled to: " . date('M d, Y', strtotime($this->rescheduleDate)) . " at " . date('h:i A', strtotime($this->rescheduleTime)),
                'type' => 'appointment_confirmation',
                'related_model' => 'Appointment',
                'related_id' => $this->selectedAppointment->id,
            ]);
        }

        $this->showRescheduleModal = false;
        $this->selectedAppointment = null;
        
        // Refresh selected date appointments
        if ($this->selectedDate) {
            $this->selectDate($this->selectedDate);
        }
        
        session()->flash('message', 'Appointment successfully rescheduled!');
    }

    public function render()
    {
        // Re-fetch selected date appointments during polling / render so it is live
        if ($this->selectedDate) {
            $this->selectedDateAppointments = Appointment::with('user')
                ->whereDate('pref_date', $this->selectedDate)
                ->orderBy('pref_time', 'asc')
                ->get();
        }
        $currentDate = Carbon::create($this->currentYear, $this->currentMonth, 1);
        $monthName = $currentDate->format('F Y');

        // Start and end of the month
        $startOfMonth = $currentDate->copy()->startOfMonth();

        // Carbon dayOfWeek is 0 (Sunday) to 6 (Saturday)
        $startDayOfWeek = $startOfMonth->dayOfWeek;

        // Previous month filler days
        $daysInPrevMonth = [];
        $prevMonthDate = $currentDate->copy()->subMonth();
        $daysToFill = $startDayOfWeek;
        $startPrevDay = $prevMonthDate->daysInMonth - $daysToFill + 1;
        for ($i = 0; $i < $daysToFill; $i++) {
            $dayNum = $startPrevDay + $i;
            $daysInPrevMonth[] = [
                'day' => $dayNum,
                'date' => $prevMonthDate->copy()->day($dayNum)->format('Y-m-d'),
                'isCurrentMonth' => false,
            ];
        }

        // Current month days
        $daysInCurrentMonth = [];
        for ($i = 1; $i <= $currentDate->daysInMonth; $i++) {
            $daysInCurrentMonth[] = [
                'day' => $i,
                'date' => $currentDate->copy()->day($i)->format('Y-m-d'),
                'isCurrentMonth' => true,
            ];
        }

        // Next month filler days (grid usually has 42 cells)
        $daysInNextMonth = [];
        $totalCells = 42; 
        $nextMonthFill = $totalCells - (count($daysInPrevMonth) + count($daysInCurrentMonth));
        if ($nextMonthFill > 7) {
            $totalCells = 35; // 5 rows if possible
            $nextMonthFill = $totalCells - (count($daysInPrevMonth) + count($daysInCurrentMonth));
        }
        $nextMonthDate = $currentDate->copy()->addMonth();
        for ($i = 1; $i <= $nextMonthFill; $i++) {
            $daysInNextMonth[] = [
                'day' => $i,
                'date' => $nextMonthDate->copy()->day($i)->format('Y-m-d'),
                'isCurrentMonth' => false,
            ];
        }

        $allDays = array_merge($daysInPrevMonth, $daysInCurrentMonth, $daysInNextMonth);

        // Fetch all appointments for the current calendar view period
        $startDateStr = reset($allDays)['date'];
        $endDateStr = end($allDays)['date'];

        $appointments = Appointment::with('user')
            ->whereBetween('pref_date', [$startDateStr, $endDateStr])
            ->get()
            ->groupBy(function ($app) {
                return Carbon::parse($app->pref_date)->format('Y-m-d');
            });

        return view('livewire.admin.calendar', [
            'monthName' => $monthName,
            'allDays' => $allDays,
            'appointments' => $appointments,
        ]);
    }
}
