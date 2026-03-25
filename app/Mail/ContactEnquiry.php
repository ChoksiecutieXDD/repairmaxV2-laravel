<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactEnquiry extends Mailable
{
    use Queueable, SerializesModels;

    public $contactEmail;
    public $contactSubject;
    public $contactMessage;

    /**
     * Create a new message instance.
     */
    public function __construct($email, $subjectLine, $messageBody)
    {
        $this->contactEmail = $email;
        $this->contactSubject = $subjectLine;
        $this->contactMessage = $messageBody;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS', 'repairmaxsample@gmail.com'))
                    ->replyTo($this->contactEmail)
                    ->subject('New Contact Enquiry: ' . $this->contactSubject)
                    ->view('emails.contact-enquiry');
    }
}
