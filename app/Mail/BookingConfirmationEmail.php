<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingConfirmationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $firstName;
    public $lastName;
    public $trackingCode;
    public $deviceBrand;
    public $deviceModel;
    public $faultCategory;
    public $description;
    public $email;

    public function __construct($firstName, $lastName, $trackingCode, $deviceBrand, $deviceModel, $faultCategory, $description, $email)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->trackingCode = $trackingCode;
        $this->deviceBrand = $deviceBrand;
        $this->deviceModel = $deviceModel;
        $this->faultCategory = $faultCategory;
        $this->description = $description;
        $this->email = $email;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Booking Confirmation - Repair Appointment Received',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.booking-confirmation',
            with: [
                'firstName' => $this->firstName,
                'lastName' => $this->lastName,
                'trackingCode' => $this->trackingCode,
                'deviceBrand' => $this->deviceBrand,
                'deviceModel' => $this->deviceModel,
                'faultCategory' => $this->faultCategory,
                'description' => $this->description,
                'email' => $this->email,
            ]
        );
    }
}
