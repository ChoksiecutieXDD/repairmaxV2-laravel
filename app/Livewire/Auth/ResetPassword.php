<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

#[Layout('components.layouts.auth', [
    'heading' => 'Reset password.',
    'subheading' => 'Enter your new password below to regain access to your Repairmax account.'
])]
#[Title('Set New Password | Repairmax')]
class ResetPassword extends Component
{
    public $token;

    #[Validate('required|email')]
    public $email;

    // The 'confirmed' rule automatically checks if this matches $password_confirmation
    #[Validate('required|min:8|confirmed')]
    public $password;

    public $password_confirmation;

    public function mount()
    {
        // Grab the token and email from the URL query string
        $this->token = request()->query('token');
        $this->email = request()->query('email');
    }

    public function updatePassword()
    {
        $this->validate();

        // 1. Check if the token exists and matches
        $record = DB::table('password_reset_tokens')
            ->where('email', $this->email)
            ->first();

        if (!$record || $record->token !== $this->token) {
            $this->addError('email', 'Invalid or expired password reset token.');
            return;
        }

        // 2. Find the user
        $user = User::where('email', $this->email)->first();
        if (!$user) {
            $this->addError('email', 'No user found with this email address.');
            return;
        }

        // 3. Update the password (Hash it!)
        $user->password = Hash::make($this->password);
        $user->save();

        // 4. Delete the token so it can't be used again
        DB::table('password_reset_tokens')->where('email', $this->email)->delete();

        // 5. Flash a success message to the session and redirect to login
        session()->flash('status', 'Your password has been reset successfully!');
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
