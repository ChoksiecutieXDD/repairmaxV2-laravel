<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Appointment;
use App\Models\Brand;
use App\Models\InventoryItem;
use App\Models\FaultType;
use App\Models\Notification;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.user')]
#[Title('Book Appointment | Repairmax')]
class BookAppointment extends Component
{
    use WithFileUploads;

    public $device_brand   = '';
    public $device_model   = '';
    public $fault_category = '';
    public $custom_service = '';
    public $description    = '';
    public $photos         = [];
    public $pref_date      = '';
    public $pref_time      = '';
    public $tracking_code  = '';

    public int $calendar_week_offset = 0;
    public ?int $selected_index  = null;
    public array $available_days  = [];

    // Standardized to 24h format for database compatibility
    public $available_slots = ['09:00', '11:00', '13:00', '15:00', '17:00'];

    public function mount()
    {
        $this->pref_date = date('Y-m-d');
        $this->generateTrackingCode();
        $this->generateAvailableDays();
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
                    $count = Appointment::where('pref_date', $dateStr)
                        ->where('pref_time', $slot)
                        ->whereIn('status', ['Pending', 'In Progress'])
                        ->count();
                    $slotStatus[$slot] = $count;
                }

                $this->available_days[] = [
                    'full'        => $dateStr,
                    'day'         => $date->format('D'),
                    'date'        => $date->format('d'),
                    'month'       => $date->format('M'),
                    'slots_left'  => max(0, count($this->available_slots) - array_sum($slotStatus)),
                    'slot_status' => $slotStatus,
                ];
                $found++;
            }
            $date->addDay();
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

    public function selectDate(int $index)
    {
        $this->selected_index = $index;
        $this->pref_date      = $this->available_days[$index]['full'];
        $this->pref_time      = '';
        $this->generateTrackingCode();
    }

    public function selectTime(string $time)
    {
        $this->pref_time = $time;
    }

    public function selectDateAndTime(int $dayIndex, string $time)
    {
        $this->selected_index = $dayIndex;
        $this->pref_date      = $this->available_days[$dayIndex]['full'];
        $this->pref_time      = $time;
        $this->generateTrackingCode();
    }

    public function generateTrackingCode()
    {
        if (!$this->pref_date) return;

        $count = Appointment::where('pref_date', $this->pref_date)->count();
        $nextNumber = str_pad($count + 1, 5, '0', STR_PAD_LEFT);
        $this->tracking_code = 'RM-' . date('Ymd', strtotime($this->pref_date)) . '-' . $nextNumber;
    }

    #[Computed]
    public function brands()
    {
        return Brand::orderBy('name')->get();
    }

    #[Computed]
    public function models()
    {
        if (!$this->device_brand) return collect();
        return \App\Models\DeviceModel::whereHas('brand', function($q) {
            $q->where('name', $this->device_brand);
        })->orderBy('name')->get();
    }

    #[Computed]
    public function faultTypes()
    {
        return FaultType::orderBy('name')->get();
    }

    public function rules()
    {
        $rules = [
            'device_brand'   => 'required|string',
            'device_model'   => 'required|string|max:255',
            'fault_category' => 'required|string',
            'description'    => 'required|string|max:1000',
            'photos.*'       => 'nullable|image|max:5120',
            'pref_date'      => 'required|date|after_or_equal:today',
            'pref_time'      => 'required',
        ];

        if ($this->fault_category === 'Other') {
            $rules['custom_service'] = 'required|string|max:255';
        }

        return $rules;
    }

    public function submit()
    {
        $this->validate();

        $photoPaths = [];
        if (!empty($this->photos)) {
            foreach ($this->photos as $photo) {
                if ($photo) {
                    $photoPaths[] = $photo->store('appointments', 'public');
                }
            }
        }

        $trackingCode = $this->tracking_code;
        $finalCategory = $this->fault_category === 'Other' ? $this->custom_service : $this->fault_category;

        $appointment = new Appointment();
        $appointment->user_id        = Auth::id();
        $appointment->tracking_code  = $trackingCode;
        $appointment->device_brand   = $this->device_brand;
        $appointment->device_model   = $this->device_model;
        $appointment->fault_category = $finalCategory;
        $appointment->description    = $this->description;
        $appointment->photo_paths    = $photoPaths;
        $appointment->pref_date      = $this->pref_date;
        $appointment->pref_time      = date("H:i:s", strtotime($this->pref_time));
        $appointment->status         = 'Pending';
        $appointment->save();

        // Create notifications for all admins
        $admins = User::where('role', 'admin')->get();
        $userFullName = Auth::user()->first_name . ' ' . Auth::user()->last_name;
        
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'admin_id' => $admin->id,
                'title' => 'New Appointment Booking',
                'message' => $userFullName . ' has booked an appointment (Tracking: ' . $trackingCode . ') for ' . $this->device_brand . ' - ' . $finalCategory,
                'type' => 'appointment_booked',
                'related_model' => 'Appointment',
                'related_id' => $appointment->id,
                'is_read' => false,
            ]);
        }

        session()->flash('success', 'Booking confirmed! Tracking code: ' . $trackingCode);
        return redirect()->route('user.dashboard');
    }

    public function render()
    {
        return view('livewire.user.book-appointment');
    }
}
