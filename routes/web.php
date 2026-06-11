<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

// Mails
use App\Mail\ContactEnquiry;
use App\Mail\BookingConfirmationEmail;
use App\Mail\TrackOtpEmail;

// Livewire Components (Auth)
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;

// Livewire Components (User)
use App\Livewire\User\Dashboard as UserDashboard;
use App\Livewire\User\Profile;
use App\Livewire\User\BookAppointment;
use App\Livewire\User\UpcomingAppointments;
use App\Livewire\User\AppointmentHistory;
use App\Livewire\User\AiSupport;
use App\Livewire\User\SupportMessage;
use App\Livewire\User\SystemSettings;
use App\Livewire\User\Notifications;
use App\Livewire\User\ServiceDetail;
use App\Livewire\User\BookedDetails;
use App\Livewire\User\Services as UserServices;

// Livewire Components (Admin)
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\SystemOverview;
use App\Livewire\Admin\Profile as AdminProfile;
use App\Livewire\Admin\Appointment as AppointmentComponent;
use App\Livewire\Admin\AppointmentDetails;
use App\Livewire\Admin\Calendar;
use App\Livewire\Admin\Inventory;
use App\Livewire\Admin\Services;
use App\Livewire\Admin\UserManagement;
use App\Livewire\Admin\AdminNotifications;
use App\Livewire\Admin\Messages;
use App\Livewire\Admin\MessagesSupport;
use App\Livewire\Admin\Reports;
use App\Livewire\Admin\ReportsAnalytics;
use App\Livewire\Admin\Settings;
use App\Livewire\Admin\Announcements;
use App\Livewire\Admin\Cities;
use App\Livewire\Admin\BrandModels;

// Controllers
use App\Http\Controllers\AppointmentDownloadController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Accessible to everyone)
|--------------------------------------------------------------------------
*/

// Core & Info Pages
use App\Http\Controllers\ChatbotController;

Route::post('/api/chatbot', [ChatbotController::class, 'sendMessage'])->name('chatbot.send');
Route::post('/api/chatbot/track', [ChatbotController::class, 'trackTicket'])->name('chatbot.track');

Route::get('/clear-cache-prod', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        return 'All caches cleared successfully!';
    } catch (\Exception $e) {
        return 'Error clearing cache: ' . $e->getMessage();
    }
});

Route::get('/run-migrations', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        return 'Migrations ran successfully!<br><pre>' . \Illuminate\Support\Facades\Artisan::output() . '</pre>';
    } catch (\Exception $e) {
        return 'Error running migrations: ' . $e->getMessage();
    }
});

Route::get('/run-seeders', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
        return 'Seeders ran successfully!<br><pre>' . \Illuminate\Support\Facades\Artisan::output() . '</pre>';
    } catch (\Exception $e) {
        return 'Error running seeders: ' . $e->getMessage();
    }
});

Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/about-us', function () {
    return view('about-us');
})->name('about');
Route::redirect('/faq', '/help/faqs')->name('faq');
Route::get('/legal-policy', function () {
    return view('legal-policy');
})->name('legal');
Route::get('/help', function () {
    return view('help');
})->name('help');

Route::get('/help/track', function () {
    return view('help.track');
})->name('help.track');

Route::post('/help/track/send-otp', function (Request $request) {
    $ticketId = $request->input('ticket_id');
    $email    = $request->input('email');

    // Step 1 — does this ticket even exist?
    $ticketExists = \App\Models\Appointment::where('tracking_code', $ticketId)
        ->orWhere('booking_number', $ticketId)
        ->exists();

    if (!$ticketExists) {
        return response()->json([
            'success' => false,
            'message' => 'Ticket number not found. Please check and try again.'
        ], 404);
    }

    // Step 2 — does the ticket exist AND match this email?
    $appointment = \App\Models\Appointment::where(function ($q) use ($ticketId) {
            $q->where('tracking_code', $ticketId)
              ->orWhere('booking_number', $ticketId);
        })
        ->whereHas('user', fn($uq) => $uq->where('email', $email))
        ->first();

    if (!$appointment) {
        // Ticket exists but email doesn't match
        return response()->json([
            'success' => false,
            'message' => 'The email address you entered is not linked to ticket ' . $ticketId . '. Please use the exact email you provided when you booked the repair.'
        ], 422);
    }

    // Generate a 6-digit OTP
    $otp = (string) mt_rand(100000, 999999);

    session([
        'track_otp'            => $otp,
        'track_ticket_id'      => $ticketId,
        'track_email'          => $email,
        'track_otp_expires_at' => now()->addMinutes(10),
        'track_verified'       => false
    ]);

    try {
        Mail::to($email)->send(new TrackOtpEmail($otp, $ticketId));
        return response()->json([
            'success' => true,
            'message' => 'Verification code sent to your email.'
        ]);
    } catch (\Exception $e) {
        Log::error('Track OTP sending failed: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Failed to send verification email. Please try again later.'
        ], 500);
    }
});

Route::post('/help/track/verify-otp', function (Request $request) {
    $otp = $request->input('otp');
    $ticketId = $request->input('ticket_id');
    $email = $request->input('email');

    $sessionOtp = session('track_otp');
    $sessionTicketId = session('track_ticket_id');
    $sessionEmail = session('track_email');
    $expiresAt = session('track_otp_expires_at');

    if (!$sessionOtp || !$expiresAt || now()->greaterThan($expiresAt)) {
        return response()->json([
            'success' => false,
            'message' => 'OTP has expired. Please request a new code.'
        ], 400);
    }

    if ($otp !== $sessionOtp || $ticketId !== $sessionTicketId || $email !== $sessionEmail) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid verification code. Please try again.'
        ], 400);
    }

    // Mark as verified
    session([
        'track_verified' => true,
        'track_verified_ticket_id' => $ticketId,
        'track_verified_email' => $email
    ]);

    return response()->json([
        'success' => true
    ]);
});

Route::post('/help/track', function (Request $request) {
    $ticketId = $request->input('ticket_id');
    $email    = $request->input('email');

    // Check session verification
    if (session('track_verified') !== true
        || session('track_verified_ticket_id') !== $ticketId
        || session('track_verified_email') !== $email) {
        return view('help.track', [
            'error'     => 'Verification required. Please complete the OTP check first.',
            'ticket_id' => $ticketId,
        ]);
    }

    // Search registered users AND guest bookings
    $appointment = \App\Models\Appointment::where(function ($q) use ($ticketId) {
            $q->where('tracking_code', $ticketId)
              ->orWhere('booking_number', $ticketId);
        })
        ->where(function ($q) use ($email) {
            // Registered user match
            $q->whereHas('user', fn($uq) => $uq->where('email', $email))
              // Guest booking match (public_email or email column)
              ->orWhere('public_email', $email)
              ->orWhere('email', $email);
        })
        ->first();

    if ($appointment) {
        return view('help.track', [
            'status'      => $appointment->status,
            'appointment' => $appointment,
            'ticket_id'   => $ticketId,
            'email'       => $email,
        ]);
    }

    return view('help.track', [
        'error'     => 'No repair found matching that Ticket Number and email. Please double-check and try again.',
        'ticket_id' => $ticketId,
        'email'     => $email,
    ]);
});

Route::get('/help/contact', function () {
    return view('help.contact');
})->name('help.contact');

Route::get('/help/faqs', function () {
    return view('help.faqs');
})->name('help.faqs');

Route::get('/help/ai-support', function () {
    return view('help.ai-support');
})->name('help.ai-support');

Route::get('/help/article/{slug}', function ($slug) {
    $articles = [
        'prepare-phone-repair' => [
            'title' => 'How to prepare your phone for repair',
            'category' => 'Getting Started & Guides',
            'content' => '
                <p class="mb-4">Before bringing or shipping your mobile device to Repairmax for diagnostics or repair, we recommend taking the following steps to protect your personal information and ensure a fast service turnaround:</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">1. Back Up Your Data</h4>
                <p class="mb-4">Always create a full backup of your phone\'s data to iCloud (for iOS devices) or Google Drive (for Android devices). While our standard repairs (like screen or battery replacements) rarely cause data loss, unforeseen hardware interactions can occur, and having a secure backup keeps your data safe.</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">2. Remove SIM Cards & MicroSD Cards</h4>
                <p class="mb-4">Remove your physical SIM card and any external MicroSD memory cards. Keep them safely at home. If you use an eSIM, there is no need to delete or disable it.</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">3. Remove Protective Cases and Accessories</h4>
                <p class="mb-4">Take off any protective cases, phone grips, ring holders, or plug-in accessories. These can obstruct our technicians\' tools and assembly fixtures.</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">4. Verify Power Status</h4>
                <p class="mb-4">If possible, charge your device to at least 30% power. This allows our technicians to run pre-repair diagnostics immediately upon receiving your phone.</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">5. Note Your Device Serial/IMEI Number</h4>
                <p class="mb-4">Write down your device Serial Number or IMEI code (found by dialing *#06# or checking your SIM tray). This helps you easily verify your booking status.</p>
            '
        ],
        'diagnostics-report' => [
            'title' => 'Understanding the Repairmax diagnostics report',
            'category' => 'Getting Started & Guides',
            'content' => '
                <p class="mb-4">When our professional technicians inspect your phone, they run an exhaustive 24-point diagnostic suite and generate an official Repairmax Diagnostics Report. Here is how to interpret your report findings:</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">1. Primary Failure Description</h4>
                <p class="mb-4">This highlights the core issue you booked for (e.g. "Cracked front digitizer glass", "Battery health at 74% with voltage instability"). This is the main focus of our repair plan.</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">2. Secondary Checks (Green/Yellow/Red status)</h4>
                <ul class="list-disc pl-6 mb-4 space-y-2">
                    <li><strong class="text-green-400">Green (Passed):</strong> Component functions within normal manufacturer tolerances (e.g. front camera, Wi-Fi module, charging port pin health).</li>
                    <li><strong class="text-yellow-400">Yellow (Notice):</strong> Component shows wear or minor degradation but is still functional (e.g. slight display burn-in, weak vibration motor). Repairs are optional.</li>
                    <li><strong class="text-red-400">Red (Failed):</strong> Component is broken, missing, or causing electrical short-circuits. Requires immediate attention to prevent system failure.</li>
                </ul>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">3. Next Steps & Approval</h4>
                <p class="mb-4">No repair is initiated without your explicit approval. The report will outline the exact parts cost and labor breakdown. You can choose to approve or reject proposed repairs directly through your booking dashboard or by replying to our SMS/email support line.</p>
            '
        ],
        'liquid-damage' => [
            'title' => 'What to do if your phone is liquid damaged',
            'category' => 'Getting Started & Guides',
            'content' => '
                <p class="mb-4">Liquid damage is time-critical. As corrosion sets in, the likelihood of a successful repair decreases. If your phone has been exposed to water, coffee, or salt water, follow these critical emergency steps immediately:</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">1. Power Off Immediately</h4>
                <p class="mb-4">Do not attempt to check if the phone is working. If it is on, turn it off right away. If it is already off, leave it off. Running electrical current through wet circuits causes immediate short-circuits and permanent chip damage.</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">2. Dry the Exterior</h4>
                <p class="mb-4">Wipe the device with a clean microfiber cloth or towel. Gently shake the phone to expel excess water from the charging port, speaker grilles, and headphone jack.</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">3. Remove Trays & Accessories</h4>
                <p class="mb-4">Take out the SIM tray immediately to let air enter. Remove any phone cases, screen protectors, or plug covers.</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">4. Do NOT Use Rice or Hair Dryers</h4>
                <p class="mb-4">Contrary to popular belief, raw rice does not dry out internal phone components quickly enough, and it deposits fine starch dust that damages mechanical parts. Hair dryers are even worse, as their heat melts interior adhesive and blows moisture deeper inside the device.</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">5. Deliver to Repairmax Desk</h4>
                <p class="mb-4">Bring your device to our service desk as soon as possible. Our technicians will open the device, perform a professional chemical wash to remove water residue, and replace components that have failed due to corrosion.</p>
            '
        ],
        'warranty-policy' => [
            'title' => 'How does the 90-Day Nationwide Warranty work?',
            'category' => 'Warranty & Policies',
            'content' => '
                <p class="mb-4">Every screen replacement, battery replacement, and motherboard repair performed by Repairmax is automatically backed by our comprehensive 90-Day Nationwide Warranty. Here is what you need to know about your coverage:</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">1. What is Covered</h4>
                <p class="mb-4">We cover any manufacturing defects in the parts we install, as well as workmanship issues related to our repair process. Examples include display touch-responsiveness issues, screen discoloration, battery failing to charge, or loose solder connections.</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">2. What is Not Covered</h4>
                <ul class="list-disc pl-6 mb-4 space-y-2">
                    <li>Physical damage (dropped screens, internal glass cracks, impact cracks).</li>
                    <li>Liquid ingress/damage after the repair date.</li>
                    <li>Software modifications, rooting, jailbreaking, or software glitches.</li>
                    <li>Repairs performed on the device by third parties after our service date.</li>
                </ul>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">3. Claiming Your Warranty</h4>
                <p class="mb-4">You can claim warranty at any Repairmax service desk nationwide. Simply bring your original booking reference number, phone, and receipt. Our team will verify the installation and replace the part free of charge if a defect is confirmed.</p>
            '
        ],
        'payment-methods' => [
            'title' => 'How to pay using GCash / Maya online',
            'category' => 'Accounts & Payments',
            'content' => '
                <p class="mb-4">Repairmax supports secure, instant online payments through top Philippine mobile wallets (GCash and Maya). Paying online speeds up your checkout and allows for contactless device pickup or courier dispatch.</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">1. Paying via Invoice link</h4>
                <p class="mb-4">Once your repair is completed, you will receive an SMS and email notification containing a secure Repairmax Payment Link. Open the link to see your final bill breakdown and select your payment method.</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">2. GCash Payment Steps</h4>
                <p class="mb-4">Select GCash on the payment page. You will be redirected to the GCash portal. Enter your GCash mobile number, input the OTP sent to your phone, verify your MPIN, and confirm the transaction. The invoice status updates to Paid immediately.</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">3. Maya QR & Checkout Steps</h4>
                <p class="mb-4">Select Maya on the payment page. You can scan the displayed dynamic QR code using your Maya app, or log in with your Maya registered mobile number and password to pay from your wallet balance.</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">4. Security Verification</h4>
                <p class="mb-4">All online transactions are encrypted and processed through BSP-licensed payment gateways. Repairmax does not store your wallet passwords or PIN codes.</p>
            '
        ],
        'receipt-details' => [
            'title' => 'Getting a physical corporate receipt for your repair',
            'category' => 'Accounts & Payments',
            'content' => '
                <p class="mb-4">If you are claiming a device repair under corporate expenses or need a BIR-compliant official receipt for tax write-offs, Repairmax provides physical receipts upon request.</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">1. Requesting During Booking</h4>
                <p class="mb-4">When booking online or checking in your device at our service desk, inform the representative that you require a Corporate Official Receipt. Provide your company’s registered name, TIN (Taxpayer Identification Number), and official billing address.</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">2. Invoiced Items</h4>
                <p class="mb-4">The receipt itemizes parts and labor separately, reflecting the 12% Value Added Tax (VAT) as mandated by Philippine tax regulations. This detail is crucial for company audit and expense approvals.</p>
                
                <h4 class="text-xl font-bold text-white mt-6 mb-3">3. Digital Invoices</h4>
                <p class="mb-4">An electronic copy of your receipt is sent to your registered email immediately upon payment clearance, which can be printed and submitted directly to your finance department.</p>
            '
        ]
    ];

    if (!array_key_exists($slug, $articles)) {
        abort(404);
    }

    return view('help.article', [
        'article' => $articles[$slug]
    ]);
})->name('help.article');

// Services & Booking Info
Route::get('/services', function () {
    $services = \App\Models\FaultType::orderBy('name', 'asc')->get();
    return view('services', compact('services'));
})->name('services');
Route::get('/services/{id}', function ($id) {
    $service = \App\Models\FaultType::findOrFail($id);
    $relatedServices = \App\Models\FaultType::where('id', '!=', $id)->inRandomOrder()->take(3)->get();
    return view('service-detail', compact('service', 'relatedServices'));
})->name('services.detail');
Route::redirect('/repairs', '/about-us');
Route::get('/booking', function () {
    return view('booking');
})->name('booking');

Route::post('/booking', function (Request $request) {
    $validated = $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:20',
        'device_type' => 'required|string',
        'brand' => 'required|string|max:255',
        'model' => 'nullable|string|max:255',
        'issue' => 'required|string',
        'device_image' => 'nullable|image|max:2048',
    ]);

    try {
        // Create or find user
        $user = User::firstOrCreate(
            ['email' => $validated['email']],
            [
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'phone' => $validated['phone'],
                'role' => 'user',
                'is_verified' => false,
            ]
        );

        // Handle image upload
        $photoPath = null;
        if ($request->hasFile('device_image')) {
            $photoPath = $request->file('device_image')->store('repairs', 'public');
        }

        /** @var \App\Models\Appointment $appointment */
        $appointment = Appointment::create([
            'user_id' => $user->id,
            'tracking_code' => 'RPR-' . strtoupper(uniqid()),
            'device_brand' => $validated['brand'],
            'device_model' => $validated['model'] ?? 'Not Specified',
            'fault_category' => $validated['device_type'],
            'description' => $validated['issue'],
            'photo_paths' => $photoPath ? [$photoPath] : [],
            'status' => 'Pending',
            'pref_date' => now()->addDay(),
            'pref_time' => '10:00:00',
        ]);

        // Send booking confirmation email
        try {
            Mail::to($user->email)->send(new BookingConfirmationEmail(
                $user->first_name,
                $user->last_name,
                $appointment->tracking_code,
                $appointment->device_brand,
                $appointment->device_model,
                $appointment->fault_category,
                $appointment->description,
                $user->email
            ));
        } catch (\Exception $e) {
            Log::error('Email sending error: ' . $e->getMessage());
        }

        return redirect('/booking')
            ->with('success', 'Thank you! Your repair booking has been received.')
            ->with('success_message', 'Booking Reference: ' . $appointment->booking_number . '. We have sent a confirmation email and our team will contact you within 24 hours to confirm the appointment details.');
    } catch (\Exception $e) {
        Log::error('Booking error: ' . $e->getMessage());
        return back()->with('error', 'There was an error processing your booking. Please try again.');
    }
})->name('booking.store');

// Track Status
Route::redirect('/track-status', '/help/track')->name('track-status');
Route::post('/track-status', function () {
    return redirect()->route('help.track');
});

// Contact & Enquiries
Route::redirect('/contact', '/help/contact')->name('contact');
Route::post('/contact/send', function (Request $request) {
    $validated = $request->validate([
        'from_email' => 'required|email',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    try {
        Mail::to('repairmaxsample@gmail.com')->send(
            new ContactEnquiry(
                $validated['from_email'],
                $validated['subject'],
                $validated['message']
            )
        );

        // Get sender user if authenticated
        $senderId = Auth::check() ? Auth::id() : null;

        // Create a message record if user is authenticated
        if ($senderId) {
            $contactMessage = \App\Models\Message::create([
                'user_id' => $senderId,
                'subject' => $validated['subject'],
                'message' => $validated['message'],
                'is_read' => false,
                'admin_read' => false,
            ]);

            // Notify all admins of new contact message
            $admins = \App\Models\User::where('role', 'admin')->get();
            $user = Auth::user();
            foreach ($admins as $admin) {
                \App\Models\Notification::create([
                    'user_id' => $admin->id,
                    'admin_id' => $admin->id,
                    'title' => 'New Contact Message',
                    'message' => $user->first_name . ' ' . $user->last_name . ' sent a contact inquiry: ' . $validated['subject'],
                    'type' => 'contact_inquiry',
                    'related_model' => 'Message',
                    'related_id' => $contactMessage->id,
                    'is_read' => false,
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Your enquiry has been sent! Our technicians will get back to you within 24 hours.'
        ]);

    } catch (\Exception $e) {
        \Log::error('Contact form error: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Sorry, there was an error sending your message. Please try again later.'
        ], 500);
    }
})->name('contact.send');

// DEBUG ROUTE - Remove in production
Route::get('/debug/appointments', function () {
    if (!Auth::check()) {
        return response('Not authenticated', 401);
    }
    
    /** @var \App\Models\User $user */
    $user = Auth::user();
    $all = $user->appointments()->get();
    $completed = $user->appointments()->whereIn('status', ['Completed', 'Cancelled'])->get();
    
    dd([
        'user' => [
            'id' => $user->id,
            'name' => $user->first_name . ' ' . $user->last_name,
            'email' => $user->email,
        ],
        'total_appointments' => $all->count(),
        'completed_appointments' => $completed->count(),
        'all_appointments' => $all->map(fn($a) => [
            'tracking_code' => $a->tracking_code,
            'status' => $a->status,
            'final_cost' => $a->final_cost,
            'completed_at' => $a->completed_at,
            'created_at' => $a->created_at,
        ]),
        'completed_only' => $completed->map(fn($a) => [
            'tracking_code' => $a->tracking_code,
            'status' => $a->status,
            'final_cost' => $a->final_cost,
        ]),
    ]);
});


/*
|--------------------------------------------------------------------------
| GUEST ROUTES (Only for logged-out users)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
});


/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES (General Logged-In Actions)
|--------------------------------------------------------------------------
*/
Route::get('/logout', function () {
    Auth::logout();
    Session::invalidate();
    Session::regenerateToken();
    return redirect('/login');
})->name('logout');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (Protected: Must be logged in AND an admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');
    Route::get('/overview', SystemOverview::class)->name('overview');
    Route::get('/profile', AdminProfile::class)->name('profile');
    
    // Appointments
    Route::get('/appointment', AppointmentComponent::class)->name('appointment');
    Route::get('/appointment/{id}/details', AppointmentDetails::class)->name('appointment.details');
    Route::get('/calendar', Calendar::class)->name('calendar');
    
    // Inventory
    Route::get('/inventory', Inventory::class)->name('inventory');
    
    // Services
    Route::get('/services', Services::class)->name('services');
    Route::get('/announcements', Announcements::class)->name('announcements');
    Route::get('/cities', Cities::class)->name('cities');
    Route::get('/brand-models', BrandModels::class)->name('brand-models');
    
    // Users
    Route::get('/user-management', UserManagement::class)->name('user-management');
    Route::get('/notifications', AdminNotifications::class)->name('notifications');
    
    // Messages & Support
    Route::get('/messages', Messages::class)->name('messages');
    Route::get('/messages-support', MessagesSupport::class)->name('messages-support');
    
    // Reports & Analytics
    Route::get('/reports', Reports::class)->name('reports');
    Route::get('/reports-analytics', ReportsAnalytics::class)->name('reports-analytics');
    
    // Settings
    Route::get('/settings', Settings::class)->name('settings');
});


/*
|--------------------------------------------------------------------------
| USER ROUTES (Protected: Must be logged in AND a standard user)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', UserDashboard::class)->name('dashboard');
    Route::get('/profile', Profile::class)->name('profile');

    // Appointments
    Route::get('/book-appointment', BookAppointment::class)->name('book-appointment');
    Route::get('/upcoming-appointments', UpcomingAppointments::class)->name('upcoming-appointments');
    Route::get('/appointment-history', AppointmentHistory::class)->name('appointment-history');
    Route::get('/appointment/{id}/receipt', [AppointmentDownloadController::class, 'downloadReceipt'])->name('appointment.receipt');
    Route::get('/appointment/{id}/invoice', [AppointmentDownloadController::class, 'downloadInvoice'])->name('appointment.invoice');
    Route::get('/appointment/{id}/receipt-view', [AppointmentDownloadController::class, 'viewReceipt'])->name('appointment.receipt-view');
    Route::get('/appointment/{id}/invoice-view', [AppointmentDownloadController::class, 'viewInvoice'])->name('appointment.invoice-view');

    // Support
    Route::get('/support', AiSupport::class)->name('ai-support');
    Route::get('/support-message', SupportMessage::class)->name('support-message');
    Route::get('/system-settings', SystemSettings::class)->name('system-settings');

    // Notifications
    Route::get('/notifications', Notifications::class)->name('notifications');
    Route::get('/booked-details/{id}', BookedDetails::class)->name('booked-details');

    // Services Details (User-specific)
    Route::get('/services', UserServices::class)->name('services');
    Route::get('/services/{id}', ServiceDetail::class)->name('services.detail');
});

Route::post('/subscribe', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
    ]);

    $emailError = null;
    try {
        Log::info('Newsletter subscription attempt for: ' . $request->email);
        Mail::to($request->email)->send(new \App\Mail\NewsletterSubscriptionEmail($request->email));
        Log::info('Newsletter subscription email sent successfully to: ' . $request->email);
    } catch (\Exception $e) {
        $emailError = $e->getMessage();
        Log::error('Newsletter Subscription Email failed: ' . $e->getMessage());
    }

    if ($request->expectsJson() || $request->ajax() || $request->headers->get('Content-Type') === 'application/json') {
        if ($emailError) {
            return response()->json([
                'success' => false,
                'message' => 'Subscription saved but email could not be sent. Error: ' . $emailError
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'Thank you for subscribing! Check your inbox.'
        ]);
    }

    return back()->with('subscribe_success', 'Thank you for subscribing! Check your inbox.');
});


/*
|--------------------------------------------------------------------------
| CHATBOT ROUTES
|--------------------------------------------------------------------------
*/
require base_path('routes/chatbot.php');


/*
|--------------------------------------------------------------------------
| FALLBACK ROUTE (Catch-all for 404s)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
