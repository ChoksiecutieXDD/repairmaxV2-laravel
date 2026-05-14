<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

#[Layout('components.layouts.admin')]
#[Title('Admin Profile | Repairmax')]
class Profile extends Component
{
    use WithFileUploads;

    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $phone = '';
    public string $department = '';
    public string $job_title = '';
    public string $bio = '';

    // Photo Upload & Cropping
    public mixed $profile_picture = null;
    public ?string $cropped_image = null;
    public ?string $current_profile_picture = null;

    public string $currentPassword = '';
    public string $newPassword = '';
    public string $confirmPassword = '';

    public $isEditing = false;

    protected $rules = [
        'first_name' => 'required|string|max:50',
        'last_name' => 'required|string|max:50',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required|string|max:15',
        'department' => 'nullable|string|max:255',
        'job_title' => 'nullable|string|max:255',
        'bio' => 'nullable|string|max:500',
    ];

    public function mount()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->phone = $user->phone;

        // Consolidated fields
        $this->bio = $user->bio ?? '';
        $this->department = $user->department ?? '';
        $this->job_title = $user->job_title ?? '';
        $this->current_profile_picture = $user->profile_picture;
    }

    public function saveChanges()
    {
        $rules = $this->rules;
        $rules['email'] = 'required|email|unique:users,email,' . Auth::id();

        $validated = $this->validate($rules);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'bio' => $this->bio,
            'department' => $this->department,
            'job_title' => $this->job_title,
        ]);

        session()->flash('success', 'Profile updated successfully!');
        $this->isEditing = false;
    }

    public function uploadProfile()
    {
        $this->validate(['profile_picture' => 'required|image|max:2048']);
        $this->dispatch('openCropperModal');
    }

    public function handleCroppedImage(string $base64String)
    {
        // Check size (approximate)
        $sizeInBytes = (int)(strlen(rtrim($base64String, '=')) * 0.75);
        if ($sizeInBytes > 2 * 1024 * 1024) {
            session()->flash('error', 'The cropped image is too large. Max 2MB allowed.');
            return;
        }

        try {
            // Remove data:image/jpeg;base64, prefix
            $imageData = str_replace('data:image/jpeg;base64,', '', $base64String);
            $imageData = str_replace(' ', '+', $imageData);

            // Decode and save
            $imageBinary = base64_decode($imageData);
            $filename = 'admin_profile_' . Auth::id() . '_' . time() . '.jpg';
            
            // Ensure directory exists
            if (!Storage::disk('public')->exists('profile_pictures')) {
                Storage::disk('public')->makeDirectory('profile_pictures');
            }
            
            Storage::disk('public')->put('profile_pictures/' . $filename, $imageBinary);
            
            // Update user
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $oldPicture = $user->profile_picture;
            $user->update(['profile_picture' => 'profile_pictures/' . $filename]);

            // Delete old picture if exists
            if ($oldPicture && Storage::disk('public')->exists($oldPicture)) {
                Storage::disk('public')->delete($oldPicture);
            }

            // Refresh user to get latest data
            $user = $user->fresh();
            $this->current_profile_picture = $user->profile_picture;
            $this->profile_picture = null;
            $this->cropped_image = null;

            session()->flash('success', 'Profile picture updated successfully!');
            $this->dispatch('refresh-page');
        } catch (\Exception $e) {
            Log::error('Profile picture error: ' . $e->getMessage());
            session()->flash('error', 'Failed to update profile picture: ' . $e->getMessage());
        }
    }

    public function deleteProfilePicture()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }

        $user->update(['profile_picture' => null]);
        $this->current_profile_picture = null;

        session()->flash('success', 'Profile picture deleted successfully!');
    }

    public function updatePassword()
    {
        $this->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:8|same:confirmPassword',
            'confirmPassword' => 'required',
        ], [
            'newPassword.same' => 'New password and confirm password do not match.',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!Hash::check($this->currentPassword, $user->password)) {
            $this->addError('currentPassword', 'Current password is incorrect.');
            return;
        }

        $user->update(['password' => Hash::make($this->newPassword)]);

        session()->flash('success', 'Password updated successfully!');
        $this->currentPassword = '';
        $this->newPassword = '';
        $this->confirmPassword = '';
        $this->dispatch('password-updated');
    }

    public function deleteAccount()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        Auth::logout();
        $user->delete();

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.admin.profile');
    }
}
