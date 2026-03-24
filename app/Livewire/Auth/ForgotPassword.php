<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.auth', [
    'heading' => 'Forgot password?',
    'subheading' => 'No problem. Just let us know your email address and we will email you a password reset link.'
])]
#[Title('Forgot Password | Repairmax')]
class ForgotPassword extends Component
{
    #[Validate('required|email')]
    public $email = '';

    public $isSent = false;
    public $errorMessage = '';

    public function sendResetLink()
    {
        $this->validate();

        $token = Str::random(64);

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $this->email],
            [
                'email' => $this->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]
        );

        $resetLink = url('/reset-password/' . $token . '?email=' . urlencode($this->email));

        try {
            // 🔥 The Laravel Way: Point to your new blade file and pass the data array
            Mail::send('emails.forgot-password', ['resetLink' => $resetLink], function ($message) {
                $message->to($this->email)
                    ->subject('Reset Your Repairmax Password');
            });

            // Trigger the sliding success UI
            $this->isSent = true;
            $this->errorMessage = '';
        } catch (\Exception $e) {
            // Catch any SMTP errors and show them on the form
            $this->errorMessage = 'Message could not be sent. Please try again later. Error: ' . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
