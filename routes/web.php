<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\Log;

// Mails
use App\Mail\ContactEnquiry;

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

// Livewire Components (Admin)
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\SystemOverview;
use App\Livewire\Admin\Profile as AdminProfile;
use App\Livewire\Admin\Appointment as AppointmentComponent;
use App\Livewire\Admin\AppointmentManagement;
use App\Livewire\Admin\Inventory;
use App\Livewire\Admin\Services;
use App\Livewire\Admin\UserManagement;
use App\Livewire\Admin\AdminNotifications;
use App\Livewire\Admin\Messages;
use App\Livewire\Admin\MessagesSupport;
use App\Livewire\Admin\Reports;
use App\Livewire\Admin\ReportsAnalytics;
use App\Livewire\Admin\Settings;
use App\Livewire\Admin\SystemSettings as AdminSystemSettings;

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

Route::post('/help/track', function (Request $request) {
    $ticketId = $request->input('ticket_id');
    $email = $request->input('email');
    
    $appointment = \App\Models\Appointment::where('tracking_code', $ticketId)
        ->whereHas('user', function ($query) use ($email) {
            $query->where('email', $email);
        })->first();

    if ($appointment) {
        return view('help.track', [
            'status' => $appointment->status,
            'appointment' => $appointment,
            'ticket_id' => $ticketId,
            'email' => $email
        ]);
    }

    return view('help.track', [
        'error' => 'No active repair found matching that Ticket ID and Email.',
        'ticket_id' => $ticketId,
        'email' => $email
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

        return redirect('/booking')
            ->with('success', 'Thank you! Your repair booking has been received.')
            ->with('success_message', 'Tracking Code: ' . $appointment->tracking_code . '. Our team will contact you shortly to confirm the appointment details.');
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

    return back()->with('success', 'Your enquiry has been sent! Our technicians will get back to you shortly.');
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
    session()->invalidate();
    session()->regenerateToken();
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
    Route::get('/appointment-management', AppointmentManagement::class)->name('appointment-management');
    
    // Inventory
    Route::get('/inventory', Inventory::class)->name('inventory');
    
    // Services
    Route::get('/services', Services::class)->name('services');
    
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
    Route::get('/system-settings', AdminSystemSettings::class)->name('system-settings');
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
});

Route::post('/subscribe', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
    ]);
    return back()->with('subscribe_success', 'Thank you for subscribing! Check your inbox.');
});


/*
|--------------------------------------------------------------------------
| FALLBACK ROUTE (Catch-all for 404s)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
