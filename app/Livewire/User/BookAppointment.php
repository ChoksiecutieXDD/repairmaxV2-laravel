<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Appointment;
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
    public $description    = '';
    public $photos         = [];
    public $pref_date      = '';
    public $pref_time      = '';

    public int $calendar_week_offset = 0;
    public ?int $selected_index  = null;
    public array $available_days  = [];

    // Standardized to 24h format for database compatibility
    public $available_slots = ['09:00', '11:00', '13:00', '15:00', '17:00'];

    public static function faultCatalogue(): array
    {
        return [
            'Screen - Cracked / Shattered'         => ['price' => 1800, 'group' => 'Screen'],
            'Screen - Dead Pixels / Discoloration' => ['price' => 1500, 'group' => 'Screen'],
            'Screen - Flickering / Ghost Touch'    => ['price' => 1200, 'group' => 'Screen'],
            'Screen - Touch Not Responding'        => ['price' => 1000, 'group' => 'Screen'],
            'Battery - Draining Too Fast'          => ['price' =>  900, 'group' => 'Battery'],
            'Battery - Not Charging'               => ['price' =>  850, 'group' => 'Battery'],
            'Battery - Swollen / Bloated'          => ['price' => 1100, 'group' => 'Battery'],
            'Battery - Phone Shuts Off Randomly'   => ['price' =>  950, 'group' => 'Battery'],
            'Charging Port - Loose / Wobbly'       => ['price' =>  650, 'group' => 'Charging Port'],
            'Charging Port - Broken / Damaged'     => ['price' =>  850, 'group' => 'Charging Port'],
            'Charging Port - Water Corrosion'      => ['price' =>  950, 'group' => 'Charging Port'],
            'Camera - Lens Cracked'                => ['price' => 1200, 'group' => 'Camera'],
            'Camera - Blurry / Unfocused Photos'   => ['price' => 1000, 'group' => 'Camera'],
            'Camera - Front Camera Not Working'    => ['price' => 1100, 'group' => 'Camera'],
            'Camera - Rear Camera Black Screen'    => ['price' => 1300, 'group' => 'Camera'],
            'Camera - Flash Not Working'           => ['price' =>  750, 'group' => 'Camera'],
            'Water Damage - Mild Exposure'         => ['price' => 2000, 'group' => 'Water Damage'],
            'Water Damage - Fully Submerged'       => ['price' => 3500, 'group' => 'Water Damage'],
            'Water Damage - Corrosion Cleaning'    => ['price' => 1800, 'group' => 'Water Damage'],
            'Software - Bootloop / Stuck on Logo'  => ['price' =>  500, 'group' => 'Software'],
            'Software - Virus / Malware'           => ['price' =>  450, 'group' => 'Software'],
            'Software - Factory Reset Needed'      => ['price' =>  350, 'group' => 'Software'],
            'Software - App Crashes / Freezing'    => ['price' =>  400, 'group' => 'Software'],
            'Software - OS Upgrade / Downgrade'    => ['price' =>  500, 'group' => 'Software'],
            'Speaker - No Sound / Low Volume'      => ['price' =>  750, 'group' => 'Speaker & Mic'],
            'Speaker - Crackling / Distorted'      => ['price' =>  700, 'group' => 'Speaker & Mic'],
            'Microphone - Not Working'             => ['price' =>  750, 'group' => 'Speaker & Mic'],
            'Earpiece - No Sound During Calls'     => ['price' =>  800, 'group' => 'Speaker & Mic'],
            'Back Cover - Cracked / Shattered'     => ['price' =>  900, 'group' => 'Physical'],
            'Frame / Housing - Bent / Dented'      => ['price' => 1200, 'group' => 'Physical'],
            'Power Button - Not Working'           => ['price' =>  700, 'group' => 'Physical'],
            'Volume Button - Not Working'          => ['price' =>  700, 'group' => 'Physical'],
            'Home Button - Not Responding'         => ['price' =>  800, 'group' => 'Physical'],
            'Fingerprint Sensor - Not Working'     => ['price' =>  950, 'group' => 'Physical'],
            'WiFi - Not Connecting'                => ['price' =>  600, 'group' => 'Connectivity'],
            'Bluetooth - Not Working'              => ['price' =>  600, 'group' => 'Connectivity'],
            'SIM Card - Not Detected'              => ['price' =>  700, 'group' => 'Connectivity'],
            'Mobile Data - No Signal'              => ['price' =>  750, 'group' => 'Connectivity'],
            'Other / Not Sure'                     => ['price' => null,  'group' => 'Other'],
        ];
    }

    public function mount()
    {
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
    }

    public function selectTime(string $time)
    {
        $this->pref_time = $time;
    }

    #[Computed]
    public function groups(): array
    {
        $groups = [];
        foreach (self::faultCatalogue() as $label => $data) {
            $groups[$data['group']][] = ['label' => $label, 'price' => $data['price']];
        }
        return $groups;
    }

    protected $rules = [
        'device_brand'  => 'required|string',
        'device_model'  => 'required|string|max:255',
        'fault_category' => 'required|string',
        'description'   => 'required|string|max:1000',
        'photos.*'      => 'nullable|image|max:5120',
        'pref_date'     => 'required|date|after_or_equal:today',
        'pref_time'     => 'required',
    ];

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

        $trackingCode = 'RM-' . strtoupper(Str::random(5));

        $appointment = new Appointment();
        $appointment->user_id        = Auth::id();
        $appointment->tracking_code  = $trackingCode;
        $appointment->device_brand   = $this->device_brand;
        $appointment->device_model   = $this->device_model;
        $appointment->fault_category = $this->fault_category;
        $appointment->description    = $this->description;
        $appointment->photo_paths    = $photoPaths;
        $appointment->pref_date      = $this->pref_date;

        /** * FIX: Convert the time format to HH:mm:ss for MySQL
         * Even if $this->pref_time is "09:00", this ensures it's "09:00:00"
         */
        $appointment->pref_time      = date("H:i:s", strtotime($this->pref_time));

        $appointment->status         = 'Pending';
        $appointment->save();

        session()->flash('success', 'Booking confirmed! Tracking code: ' . $trackingCode);
        return redirect()->route('user.dashboard');
    }

    public function render()
    {
        return view('livewire.user.book-appointment', [
            'fault_catalogue' => self::faultCatalogue(),
        ]);
    }
}
