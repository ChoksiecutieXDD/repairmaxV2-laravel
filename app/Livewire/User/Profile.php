<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('layouts.user')]
#[Title('Profile | Repairmax')]
class Profile extends Component
{
    // Form variables mapped to the user
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $phone = '';

    // Additional info (Add these columns to your users table if you want to save them!)
    public $age = '';
    public $gender = '';
    public $address = '';
    public $city = '';
    public $province = '';
    public $country = 'PH';

    // Password Update variables
    public $current_password = '';
    public $new_password = '';
    public $confirm_password = '';

    public function mount()
    {
        // When the page loads, populate the form with the user's current data
        $user = Auth::user();

        $this->first_name = $user->first_name ?? '';
        $this->last_name = $user->last_name ?? '';
        $this->email = $user->email ?? '';

        // If you add these to your database, uncomment them here
        // $this->phone = $user->phone;
        // $this->address = $user->address;
        // $this->city = $user->city;
        // $this->province = $user->province;
    }

    public function updateProfile()
    {
        // Add validation and saving logic here later
        session()->flash('success', 'Profile updated successfully.');
    }

    public function updatePassword()
    {
        // Add password validation and hashing logic here later
        session()->flash('password_success', 'Password updated successfully.');
    }

    public function render()
    {
        return view('livewire.user.profile', [
            'user' => Auth::user(),
        ]);
    }
}
