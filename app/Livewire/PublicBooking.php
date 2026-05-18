<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Models\Appointment;
use App\Models\Brand;
use App\Models\FaultType;
use App\Models\Notification;
use App\Models\User;

class PublicBooking extends Component
{
    use WithFileUploads;

    // Guest details
    public $first_name     = '';
    public $last_name      = '';
    public $email          = '';
    public $phone          = '';
    public $city           = '';
    
    // Pickup and Address details
    public $address        = '';
    public $pickup_option  = 'Drop-off'; // Default to Drop-off at Shop
    public $other_details  = '';

    // Device and booking details
    public $device_brand   = '';
    public $device_model   = '';
    public $custom_brand   = '';
    public $custom_model   = '';
    public $fault_category = '';
    public $custom_service = '';
    public $description    = '';
    public $photos         = [];
    public mixed $video          = null;
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

        // Read query parameter for pre-selecting service
        $selectedService = Request::query('service');
        if ($selectedService) {
            $fault = FaultType::where('name', $selectedService)->first();
            if ($fault) {
                $this->fault_category = $fault->name;
            } else {
                // If it doesn't match any standard service, set to 'Other' and pre-fill custom service
                $this->fault_category = 'Other';
                $this->custom_service = $selectedService;
            }
        }
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
        if (!$this->device_brand || $this->device_brand === 'Other') return collect();
        return \App\Models\DeviceModel::whereHas('brand', function($q) {
            $q->where('name', $this->device_brand);
        })->orderBy('name')->get();
    }

    #[Computed]
    public function faultTypes()
    {
        return FaultType::orderBy('name')->get();
    }

    public function updatedPhotos($value, int|string $key)
    {
        if (isset($this->photos[$key]) && $this->photos[$key]) {
            try {
                $ext = strtolower($this->photos[$key]->getClientOriginalExtension());
                if (!in_array($ext, ['jpeg', 'jpg', 'png'])) {
                    $this->photos[$key] = null;
                    $this->dispatch('toast', message: 'Invalid image format! Only JPEG, JPG, and PNG are allowed.', type: 'error');
                    return;
                }
                if ($this->photos[$key]->getSize() > 2 * 1024 * 1024) {
                    $this->photos[$key] = null;
                    $this->dispatch('toast', message: 'Image size exceeded! Maximum 2MB allowed per image.', type: 'error');
                }
            } catch (\Exception $e) {
                // Silently handle temporary upload reading exceptions
            }
        }
    }

    public function updatedVideo()
    {
        if ($this->video) {
            try {
                $ext = strtolower($this->video->getClientOriginalExtension());
                if (!in_array($ext, ['mp4', 'webm'])) {
                    $this->video = null;
                    $this->dispatch('toast', message: 'Invalid video format! Only MP4 and WEBM are allowed.', type: 'error');
                    return;
                }
                if ($this->video->getSize() > 100 * 1024 * 1024) {
                    $this->video = null;
                    $this->dispatch('toast', message: 'Video size exceeded! Maximum 100MB allowed.', type: 'error');
                }
            } catch (\Exception $e) {
                // Silently handle temporary upload reading exceptions
            }
        }
    }

    public function rules()
    {
        $rules = [
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'phone'          => 'required|string|max:20',
            'city'           => 'required|string|max:100',
            'device_brand'   => 'required|string',
            'device_model'   => 'required|string|max:255',
            'fault_category' => 'required|string',
            'description'    => 'required|string|max:1000',
            'photos.*'       => 'nullable|file|mimes:jpeg,jpg,png|max:2048', // 2MB Max (JPEG, JPG, PNG)
            'video'          => 'nullable|file|mimes:mp4,webm|max:102400', // 100MB Max (MP4, WEBM)
            'pref_date'      => 'required|date|after_or_equal:today',
            'pref_time'      => 'required',
            'pickup_option'  => 'required|string|in:Drop-off,Pickup',
            'address'        => 'required|string|max:500',
            'other_details'  => 'nullable|string|max:1000',
        ];

        if ($this->device_brand === 'Other') {
            $rules['device_model'] = 'nullable|string';
            $rules['custom_brand'] = 'required|string|max:255';
            $rules['custom_model'] = 'required|string|max:255';
        } elseif ($this->device_model === 'Other') {
            $rules['custom_model'] = 'required|string|max:255';
        }

        if ($this->fault_category === 'Other') {
            $rules['custom_service'] = 'required|string|max:255';
        }

        return $rules;
    }

    public function submit()
    {
        $this->validate();

        // Create or find guest user profile, and update details
        $user = User::firstOrCreate(
            ['email' => $this->email],
            [
                'role' => 'user',
                'is_verified' => false,
            ]
        );
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->phone = $this->phone;
        $user->address = $this->address;
        $user->city = $this->city;
        $user->save();

        $photoPaths = [];
        // Store video first if uploaded
        if ($this->video) {
            $photoPaths[] = $this->video->store('appointments', 'public');
        }
        // Store photos
        if (!empty($this->photos)) {
            foreach ($this->photos as $photo) {
                if ($photo) {
                    $photoPaths[] = $photo->store('appointments', 'public');
                }
            }
        }

        $trackingCode = $this->tracking_code;
        $finalBrand = $this->device_brand === 'Other' ? $this->custom_brand : $this->device_brand;
        $finalModel = ($this->device_brand === 'Other' || $this->device_model === 'Other') ? $this->custom_model : $this->device_model;
        $finalCategory = $this->fault_category === 'Other' ? $this->custom_service : $this->fault_category;

        // Construct full description incorporating new pickup and address details securely
        $fullDescription = "Issue Description:\n" . $this->description;
        $fullDescription .= "\n\nService Method:\n" . ($this->pickup_option === 'Pickup' ? 'Home Pickup & Return' : 'Drop-off at Shop');
        $fullDescription .= "\n\nPickup Address:\n" . $this->address . ", " . $this->city;
        if (!empty($this->other_details)) {
            $fullDescription .= "\n\nOther Details / Special Instructions:\n" . $this->other_details;
        }

        $appointment = new Appointment();
        $appointment->user_id        = $user->id;
        $appointment->tracking_code  = $trackingCode;
        $appointment->device_brand   = $finalBrand;
        $appointment->device_model   = $finalModel;
        $appointment->fault_category = $finalCategory;
        $appointment->description    = $fullDescription;
        $appointment->photo_paths    = $photoPaths;
        $appointment->pref_date      = $this->pref_date;
        $appointment->pref_time      = date("H:i:s", strtotime($this->pref_time));
        $appointment->status         = 'Pending';
        $appointment->save();

        // Create notifications for all admins
        $admins = User::where('role', 'admin')->get();
        $userFullName = $this->first_name . ' ' . $this->last_name;
        
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'admin_id' => $admin->id,
                'title' => 'New Appointment Booking',
                'message' => $userFullName . ' has booked a repair appointment (Tracking: ' . $trackingCode . ') for ' . $finalBrand . ' - ' . $finalCategory,
                'type' => 'appointment_booked',
                'related_model' => 'Appointment',
                'related_id' => $appointment->id,
                'is_read' => false,
            ]);
        }

        Session::flash('success', 'Booking confirmed! Tracking code: ' . $trackingCode);
        Session::flash('success_message', 'Tracking Code: ' . $trackingCode . '. Our team will contact you shortly to confirm the appointment details.');

        return redirect()->route('booking');
    }

    public function render()
    {
        return view('livewire.public-booking');
    }
}
