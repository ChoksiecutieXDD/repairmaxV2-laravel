<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TrackOtpEmail extends Mailable
{
    use Queueable, SerializesModels;

    public string $otp;
    public string $ticketId;

    /**
     * Create a new message instance.
     */
    public function __construct(string $otp, string $ticketId)
    {
        $this->otp = $otp;
        $this->ticketId = $ticketId;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Repairmax Verification Code: ' . $this->otp,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.track-otp',
            with: [
                'otp' => $this->otp,
                'ticketId' => $this->ticketId,
            ]
        );
    }
}
