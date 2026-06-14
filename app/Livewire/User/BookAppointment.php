<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use App\Models\Appointment;
use App\Models\Brand;
use App\Models\InventoryItem;
use App\Models\FaultType;
use App\Models\Notification;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppointmentDetailsEmail;

#[Layout('layouts.user')]
#[Title('Book Appointment | Repairmax')]
class BookAppointment extends Component
{
    use WithFileUploads;

    // Personal details
    public $first_name     = '';
    public $last_name      = '';
    public $email          = '';
    public $phone          = '';
    public $city           = '';

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
    public $booking_number = '';
    public $showReviewModal = false;
    public $payment_method = 'Cash';

    // Pickup and Address details
    public $address        = '';
    public $barangay       = '';
    public $pickup_option  = 'Drop-off'; // Default to Drop-off at Shop
    public $other_details  = '';
    public $additional_fee = 0;

    // Alternative Address details
    public $alt_address      = '';
    public $alt_barangay     = '';
    public $alt_city         = '';
    public $use_same_address = true;

    public int $calendar_week_offset = 0;
    public ?int $selected_index  = null;
    public array $available_days  = [];

    // Standardized to 24h format for database compatibility
    public $available_slots = ['09:00', '11:00', '13:00', '15:00', '17:00'];

    public function mount()
    {
        $user = Auth::user();
        if ($user) {
            $this->first_name = $user->first_name ?? '';
            $this->last_name  = $user->last_name ?? '';
            $this->email      = $user->email ?? '';
            $this->phone      = $user->phone ?? '';
            $this->address    = $user->address ?? '';
            $this->barangay   = $user->barangay ?? '';
            // Only pre-fill city if it's a recognized supported city; otherwise leave blank
            $userCity = $user->city ?? '';
            $supported = \App\Models\SupportedCity::where('is_active', true)->pluck('name')->toArray();
            $this->city = in_array($userCity, $supported) ? $userCity : '';

            $this->alt_address  = $user->alt_address ?? '';
            $this->alt_barangay = $user->alt_barangay ?? '';
            $this->alt_city     = in_array($user->alt_city ?? '', $supported) ? $user->alt_city : '';
            
            if ($this->address && ($this->address !== $this->alt_address || $this->barangay !== $this->alt_barangay || $this->city !== $this->alt_city)) {
                $this->use_same_address = false;
            }
        }
        $this->calculateAdditionalFee();
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
                        ->where('pref_time', 'like', $slot . '%')
                        ->whereIn('status', ['Pending', 'In Progress'])
                        ->count();
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

        // Auto-sync selected_index based on pref_date
        $this->selected_index = null;
        if ($this->pref_date) {
            foreach ($this->available_days as $idx => $day) {
                if ($day['full'] === $this->pref_date) {
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
        $maxId = Appointment::max('id') ?? 0;
        $nextNumber = str_pad($maxId + 1, 5, '0', STR_PAD_LEFT);
        $this->tracking_code = 'RM-' . $nextNumber;
        $this->booking_number = 'RM-' . $nextNumber;
    }

    public function calculateAdditionalFee()
    {
        if ($this->pickup_option === 'Pickup' && $this->city) {
            $cityRecord = \App\Models\SupportedCity::where('name', $this->city)->first();
            $this->additional_fee = $cityRecord ? $cityRecord->shipping_fee : 0;
        } else {
            $this->additional_fee = 0;
        }
    }

    public function updatedCity($value)
    {
        $this->city = $value;
        $this->calculateAdditionalFee();
    }

    public function updatedPickupOption($value)
    {
        $this->pickup_option = $value;
        $this->calculateAdditionalFee();
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

    #[Computed]
    public function cities()
    {
        return \App\Models\SupportedCity::where('is_active', true)->orderBy('name')->get();
    }

    #[Computed]
    public function activeAnnouncement()
    {
        return \App\Models\Announcement::where('is_active', true)->latest()->first();
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
            'email'          => [
                'required',
                'email',
                'max:255',
                function ($attribute, $value, $fail) {
                    $loggedUser = Auth::user();
                    if ($loggedUser && $value === $loggedUser->email) {
                        return;
                    }
                    $user = User::where('email', $value)->first();
                    if ($user && $user->role !== 'guest') {
                        $fail('This email is already registered to a user account.');
                    }
                }
            ],
            'phone'          => 'required|string|max:20',
            'city'           => 'required|string|exists:supported_cities,name',
            'barangay'       => 'required|string|max:255',
            'alt_city'       => 'required|string|exists:supported_cities,name',
            'alt_barangay'   => 'required|string|max:255',
            'alt_address'    => 'required|string|max:500',
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
            'payment_method' => 'required|string|in:Cash,Online',
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

    public function validationFailed($validator)
    {
        $this->dispatch('toast', message: 'Please fill in all required fields correctly!', type: 'error');
    }

    public function prepareReview()
    {
        if ($this->use_same_address) {
            $this->alt_address = $this->address;
            $this->alt_barangay = $this->barangay;
            $this->alt_city = $this->city;
        }

        try {
            $this->validate();
            $this->showReviewModal = true;
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('toast', message: 'Please fill in all required fields correctly!', type: 'error');
            throw $e;
        }
    }

    public function submit()
    {
        if ($this->use_same_address) {
            $this->alt_address = $this->address;
            $this->alt_barangay = $this->barangay;
            $this->alt_city = $this->city;
        }

        try {
            $this->validate();
            $this->showReviewModal = false;
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('toast', message: 'Please fill in all required fields correctly!', type: 'error');
            throw $e;
        }

        // Re-save or update user profile with latest contact details
        /** @var \App\Models\User $loggedUser */
        $loggedUser = Auth::user();
        $targetUserId = Auth::id();

        if ($loggedUser) {
            if ($this->email === $loggedUser->email) {
                $loggedUser->first_name = $this->first_name;
                $loggedUser->last_name  = $this->last_name;
                $loggedUser->phone      = $this->phone;
                $loggedUser->address    = $this->address;
                $loggedUser->barangay   = $this->barangay;
                $loggedUser->city       = $this->city;
                $loggedUser->alt_address = $this->alt_address;
                $loggedUser->alt_barangay = $this->alt_barangay;
                $loggedUser->alt_city   = $this->alt_city;
                $loggedUser->save();
                $targetUserId = $loggedUser->id;
            } else {
                $guestUser = User::firstOrNew(['email' => $this->email]);
                $guestUser->first_name = $this->first_name;
                $guestUser->last_name  = $this->last_name;
                $guestUser->phone      = $this->phone;
                $guestUser->address    = $this->address;
                $guestUser->barangay   = $this->barangay;
                $guestUser->city       = $this->city;
                $guestUser->alt_address = $this->alt_address;
                $guestUser->alt_barangay = $this->alt_barangay;
                $guestUser->alt_city   = $this->alt_city;
                if (!$guestUser->exists) {
                    $guestUser->role = 'guest';
                    $guestUser->is_verified = false;
                    $guestUser->password = \Illuminate\Support\Facades\Hash::make(Str::random(16));
                }
                $guestUser->save();
                $targetUserId = $guestUser->id;
            }
        }

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
        $fullDescription .= "\n\nPickup Address:\n" . $this->address . ", Brgy. " . $this->barangay . ", " . $this->city;
        if ($this->alt_address) {
            $fullDescription .= "\n\nAlternative Address:\n" . $this->alt_address . ", Brgy. " . $this->alt_barangay . ", " . $this->alt_city;
        }
        if (!empty($this->other_details)) {
            $fullDescription .= "\n\nOther Details / Special Instructions:\n" . $this->other_details;
        }
        $fullDescription .= "\n\nPayment Method:\n" . $this->payment_method;

        $this->calculateAdditionalFee();
        $selectedFault = ($finalCategory && $finalCategory !== 'Other') ? \App\Models\FaultType::where('name', $finalCategory)->first() : null;
        $basePrice = $selectedFault ? $selectedFault->base_price : 0;
        $calculatedQuote = $basePrice + $this->additional_fee;

        $appointment = new Appointment();
        $appointment->user_id        = $targetUserId;
        $appointment->tracking_code  = $trackingCode;
        $appointment->device_brand   = $finalBrand;
        $appointment->device_model   = $finalModel;
        $appointment->fault_category = $finalCategory;
        $appointment->description    = $fullDescription;
        $appointment->photo_paths    = $photoPaths;
        $appointment->pref_date      = $this->pref_date;
        $appointment->pref_time      = date("H:i:s", strtotime($this->pref_time));
        $appointment->status         = 'Pending';
        $appointment->service_method = $this->pickup_option;
        $appointment->address        = $this->address;
        $appointment->barangay       = $this->barangay;
        $appointment->city           = $this->city;
        $appointment->alt_address    = $this->alt_address;
        $appointment->alt_barangay   = $this->alt_barangay;
        $appointment->alt_city       = $this->alt_city;
        $appointment->additional_fee = $this->additional_fee;
        $appointment->quote          = $calculatedQuote;
        $appointment->booking_number = $trackingCode;
        $appointment->save();

        // Auto-generate invoice number based on appointment ID (INV-#####)
        $appointment->invoice_number = 'INV-' . str_pad($appointment->id, 5, '0', STR_PAD_LEFT);
        $appointment->save();

        // Create notifications for all admins
        $admins = User::where('role', 'admin')->get();
        $userFullName = $this->first_name . ' ' . $this->last_name;
        
        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'admin_id' => $admin->id,
                'title' => 'New Appointment Booking',
                'message' => $userFullName . ' has booked an appointment (Tracking: ' . $trackingCode . ') for ' . $finalBrand . ' - ' . $finalCategory,
                'type' => 'appointment_booked',
                'related_model' => 'Appointment',
                'related_id' => $appointment->id,
                'is_read' => false,
            ]);
        }

        // Send appointment details email to user
        try {
            Mail::to($this->email)->send(new AppointmentDetailsEmail($appointment));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Failed to send appointment details email: ' . $e->getMessage());
        }

        Session::flash('success', 'Booking confirmed! Ticket Number: ' . $appointment->tracking_code);
        return redirect()->route('user.dashboard');
    }

    #[Computed]
    public function hasOngoingBookings()
    {
        if (empty($this->email)) {
            return false;
        }

        $loggedUser = Auth::user();
        if ($loggedUser && $this->email === $loggedUser->email) {
            return false;
        }

        $user = User::where('email', $this->email)->first();
        if ($user && $user->role !== 'guest') {
            return false;
        }

        return Appointment::whereHas('user', function($q) {
            $q->where('email', $this->email);
        })->whereNotIn('status', ['Completed', 'Cancelled'])->exists();
    }

    public function render()
    {
        return view('livewire.user.book-appointment');
    }
}

