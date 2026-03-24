<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

// Moved the heading and subheading up here so the layout catches them perfectly!
#[Layout('components.layouts.auth', [
    'heading' => 'Welcome back.',
    'subheading' => 'Log in to your account to book appointments and track your device repairs.'
])]
#[Title('Log In | Repairmax')]
class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function login()
    {
        $this->validate();

        // Attempt to log the user in
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();

            // Check if the account is active before letting them in
            if (Auth::user()->is_active == 0) {
                Auth::logout();

                $this->dispatch(
                    'open-modal',
                    title: 'Account Deactivated',
                    message: 'Your Repairmax account has been deactivated. Please contact support to restore access.'
                );
                return;
            }

            // Determine the correct route based on role
            $redirectUrl = Auth::user()->role === 'admin' ? '/admin/dashboard' : '/user/dashboard';

            // 🔥 Instead of redirecting instantly, trigger the success modal!
            $this->dispatch('login-success', url: $redirectUrl);

            return;
        }

        // If auth fails, throw an error
        $this->addError('email', 'The provided credentials do not match our records.');
    }

    public function render()
    {
        return view('auth.login');
    }
}
