<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $firstName;

    public function __construct($firstName)
    {
        // We pass the user's first name in when we trigger the email
        $this->firstName = $firstName;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to Repairmax!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome', // This points to the blade file we just made
            with: [
                'firstName' => $this->firstName,
            ]
        );
    }
}
