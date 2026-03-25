<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
use App\Livewire\User\SystemSettings;
use App\Livewire\User\Notifications;

// Livewire Components (Admin)
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\SystemOverview;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Accessible to everyone)
|--------------------------------------------------------------------------
*/

// Core & Info Pages
Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/about-us', function () {
    return view('about-us');
})->name('about');
Route::get('/faq', function () {
    return view('faq');
})->name('faq');
Route::get('/legal-policy', function () {
    return view('legal-policy');
})->name('legal');

// Services & Booking Info
Route::get('/services', function () {
    return view('services');
})->name('services');
Route::get('/repairs', function () {
    return view('repairs');
})->name('repairs');
Route::get('/booking', function () {
    return view('booking');
})->name('booking');

// Track Status
Route::get('/track-status', function () {
    return view('track-status');
})->name('track-status');
Route::post('/track-status', function () {
    return view('track-status', ['status' => 'In Progress']);
});

// Contact & Enquiries
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
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

    return back()->with('success', 'Your enquiry has been sent! Our technicians will get back to you shortly.');
})->name('contact.send');


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
    Route::get('/user-management', function () {
        return view('admin-profile.user-management');
    })->name('user-management');
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

    // Support
    Route::get('/support', AiSupport::class)->name('ai-support');
    Route::get('/system-settings', SystemSettings::class)->name('system-settings');

    // Notifications
    Route::get('/notifications', Notifications::class)->name('notifications');
});


/*
|--------------------------------------------------------------------------
| FALLBACK ROUTE (Catch-all for 404s)
|--------------------------------------------------------------------------
*/
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
