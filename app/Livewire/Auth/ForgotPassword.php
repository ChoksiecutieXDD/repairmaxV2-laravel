<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
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

        $resetLink = url('/reset-password?token=' . $token . '&email=' . urlencode($this->email));

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'repairmaxsample@gmail.com';
            $mail->Password   = 'mlxg ygtu irzb ottv';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('repairmaxsample@gmail.com', 'Repairmax Admin');
            $mail->addAddress($this->email);

            $mail->isHTML(true);
            $mail->Subject = 'Reset Your Repairmax Password';
            $mail->Body    = "
                <h3>Hello!</h3>
                <p>We received a password reset request for your account.</p>
                <p><a href='{$resetLink}' style='display:inline-block;padding:10px 20px;background-color:#212529;color:#ffffff;text-decoration:none;border-radius:5px;'>Reset Password</a></p>
                <p>If you did not request this, please ignore this email.</p>
            ";

            $mail->send();

            $this->isSent = true;
            $this->errorMessage = '';
        } catch (Exception $e) {
            $this->errorMessage = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
