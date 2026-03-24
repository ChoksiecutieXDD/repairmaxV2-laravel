<?php

namespace App\Http\Controllers;

use App\Mail\ContactEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Handle contact form submission
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'from_email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:5000',
        ]);

        try {
            // Get the admin email from .env
            $adminEmail = env('MAIL_FROM_ADDRESS', 'repairmaxsample@gmail.com');

            // Send email to admin about the enquiry
            Mail::to($adminEmail)->send(new ContactEnquiry(
                $validated['from_email'],
                $validated['subject'],
                $validated['message']
            ));

            // Return success response
            return redirect()->back()
                ->with('success', 'Thank you for your enquiry! We\'ll get back to you soon.')
                ->with('success_message', 'Your message has been sent successfully. The Repairmax team will review your enquiry and respond within 24 hours.');

        } catch (\Exception $e) {
            // Log the error
            \Log::error('Contact form error: ' . $e->getMessage());

            // Return error response
            return redirect()->back()
                ->with('error', 'Sorry, there was an error sending your message. Please try again later.')
                ->with('error_details', $e->getMessage());
        }
    }
}
