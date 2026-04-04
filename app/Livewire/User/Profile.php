<?php

namespace App\Livewire\User;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;

#[Layout('layouts.user')]
#[Title('Profile | Repairmax')]
class Profile extends Component
{
    use WithFileUploads;

    // Basic Info
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $phone = '';

    // Profile Details (Consolidated)
    public $bio = '';
    public $age = '';
    public $gender = '';
    public $address = '';
    public $city = '';
    public $province = '';
    public $country = 'PH';

    // Photo Upload & Cropping
    public $profile_picture;
    public $cropped_image;
    public $current_profile_picture;

    // Security
    public $current_password = '';
    public $new_password = '';
    public $confirm_password = '';

    public function mount()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Added ?? '' to prevent null values from breaking the input hydration
        $this->first_name = $user->first_name ?? '';
        $this->last_name = $user->last_name ?? '';
        $this->email = $user->email ?? '';
        $this->phone = $user->phone ?? '';
        $this->address = $user->address ?? '';
        $this->city = $user->city ?? '';
        $this->province = $user->state ?? ''; // Assuming DB column is 'state'
        $this->country = $user->country ?? 'PH';

        $this->bio = $user->bio ?? '';
        $this->gender = $user->gender ?? '';

        if ($user->date_of_birth) {
            try {
                $this->age = \Carbon\Carbon::parse($user->date_of_birth)->diffInYears(now());
            } catch (\Exception $e) {
                $this->age = '';
            }
        }

        $this->current_profile_picture = $user->profile_picture;
    }

    public function handleCroppedImage($base64Data)
    {
        $sizeInBytes = (int)(strlen(rtrim($base64Data, '=')) * 0.75);
        if ($sizeInBytes > 1024 * 1024) {
            $this->dispatch('toast', message: 'Image is too large. Max 1MB allowed.', type: 'error');
            $this->cropped_image = null;
            return;
        }

        $this->cropped_image = $base64Data;
        $this->dispatch('toast', message: 'Image cropped successfully!', type: 'success');
    }

    public function updateProfile()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $this->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            // Email validation removed because the input is readonly
            'phone' => 'nullable|string|max:15',
            'age' => 'nullable|numeric|between:13,120',
            'gender' => 'nullable|in:male,female,other',
            'address' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'country' => 'nullable|string|max:50',
            'bio' => 'nullable|string|max:500',
        ]);

        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->province,
            'country' => $this->country,
            'bio' => $this->bio,
            'gender' => $this->gender,
        ];

        if ($this->age) {
            $data['date_of_birth'] = now()->subYears($this->age)->format('Y-m-d');
        }

        if ($this->cropped_image) {
            if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
                Storage::disk('public')->delete($user->profile_picture);
            }

            $image_parts = explode(";base64,", $this->cropped_image);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);

            $filename = 'profile-photos/' . uniqid() . '.' . $image_type;

            Storage::disk('public')->put($filename, $image_base64);
            $data['profile_picture'] = $filename;
            $this->current_profile_picture = $filename;
            $this->cropped_image = null;
        }

        $user->update($data);

        $this->dispatch('toast', message: 'Profile updated successfully!', type: 'success');
    }

    public function updatePassword()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        if (!Hash::check($this->current_password, $user->password)) {
            $this->dispatch('toast', message: 'Current password is incorrect.', type: 'error');
            return;
        }

        $user->update([
            'password' => Hash::make($this->new_password)
        ]);

        $this->reset(['current_password', 'new_password', 'confirm_password']);
        $this->dispatch('toast', message: 'Password updated successfully!', type: 'success');
    }

    public function deleteAccount()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->delete();

        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        session()->flash('info', 'Your account has been deleted.');
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.user.profile', [
            'user' => Auth::user(),
        ]);
    }
}
