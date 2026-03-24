<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Mail\WelcomeEmail; // 🔥 1. Import your new Mailable class

#[Layout('components.layouts.auth', [
    'heading' => 'Create an account.',
    'subheading' => 'Join Repairmax today to easily track your device repairs and manage service tickets.'
])]
#[Title('Register | Repairmax')]
class Register extends Component
{
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $password = '';

    // Controls the UI state
    public $isRegistered = false;

    protected function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name'  => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => [
                'required',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
        ];
    }

    public function register()
    {
        $this->validate();

        // 1. Create the user
        User::create([
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'email'      => $this->email,
            'password'   => Hash::make($this->password),
        ]);

        // 🔥 2. Send the Branded HTML Welcome Email using the Mailable
        Mail::to($this->email)->send(new WelcomeEmail($this->first_name));

        // 3. Trigger the success UI
        $this->isRegistered = true;
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
