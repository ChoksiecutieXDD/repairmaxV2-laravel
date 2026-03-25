<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads; // Crucial for handling file uploads!
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

    public $device_brand = '';
    public $device_model = '';
    public $fault_category = '';
    public $description = '';
    public $photo; // Holds the uploaded file
    public $pref_date = '';
    public $pref_time = '';

    protected $rules = [
        'device_brand' => 'required|string',
        'device_model' => 'required|string|max:255',
        'fault_category' => 'required|string',
        'description' => 'required|string|max:1000',
        'photo' => 'nullable|image|max:5120', // Max 5MB, must be an image
        'pref_date' => 'required|date|after_or_equal:today',
        'pref_time' => 'required',
    ];

    public function submit()
    {
        $this->validate();

        $photoPath = null;
        if ($this->photo) {
            // Stores the image in storage/app/public/appointments
            $photoPath = $this->photo->store('appointments', 'public');
        }

        // Generate a random tracking code (e.g., RM-8A4B2)
        $trackingCode = 'RM-' . strtoupper(Str::random(5));

        Appointment::create([
            'user_id' => Auth::id(),
            'tracking_code' => $trackingCode,
            'device_brand' => $this->device_brand,
            'device_model' => $this->device_model,
            'fault_category' => $this->fault_category,
            'description' => $this->description,
            'photo_path' => $photoPath,
            'pref_date' => $this->pref_date,
            'pref_time' => $this->pref_time,
            'status' => 'Pending',
        ]);

        // Redirect to dashboard with a success message
        session()->flash('success', 'Appointment booked successfully! Your tracking code is ' . $trackingCode);
        return redirect()->route('user.dashboard');
    }

    public function render()
    {
        return view('livewire.user.book-appointment');
    }
}
