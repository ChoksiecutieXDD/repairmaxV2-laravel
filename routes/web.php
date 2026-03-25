<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Livewire Components
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;

// Admin Livewire Components
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\DashboardOverview;
use App\Livewire\Admin\Profile;
use App\Livewire\Admin\UserManagement;
use App\Livewire\Admin\Appointment;
use App\Livewire\Admin\AppointmentManagement;
use App\Livewire\Admin\Inventory;
use App\Livewire\Admin\InventoryManagement;
use App\Livewire\Admin\Messages;
use App\Livewire\Admin\MessagesSupport;
use App\Livewire\Admin\Reports;
use App\Livewire\Admin\ReportsAnalytics;
use App\Livewire\Admin\Settings;
use App\Livewire\Admin\SystemSettings;

// Controllers
use App\Http\Controllers\ContactController;

// ==========================================
// PUBLIC ROUTES (Accessible to everyone)
// ==========================================
Route::get('/', function () {
    return view('welcome');
})->name('home');
Route::get('/about-us', function () {
    return view('about-us');
})->name('about');
Route::get('/services', function () {
    return view('services');
})->name('services');
Route::get('/repairs', function () {
    return view('repairs');
})->name('repairs');
Route::get('/faq', function () {
    return view('faq');
})->name('faq');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Route::post('/contact/send', [ContactController::class, 'store'])->name('contact.send');
Route::get('/legal-policy', function () {
    return view('legal-policy');
})->name('legal');
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


// ==========================================
// GUEST ROUTES (Only for logged-out users)
// ==========================================
Route::middleware('guest')->group(function () {
    // Livewire handles the display and the form submission for all of these automatically
    Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');

    // We name this 'password.request' because Laravel's core auth system looks for this specific name
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
});


// ==========================================
// AUTHENTICATED LOGOUT
// ==========================================
Route::get('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login');
})->name('logout');


// ==========================================
// ADMIN ROUTES (Protected: Must be logged in AND an admin)
// ==========================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Main
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/dashboard-overview', DashboardOverview::class)->name('dashboard-overview');
    Route::get('/profile', Profile::class)->name('profile');

    // Appointments
    Route::get('/appointment', Appointment::class)->name('appointment');
    Route::get('/appointment-management', AppointmentManagement::class)->name('appointment-management');

    // Inventory
    Route::get('/inventory', Inventory::class)->name('inventory');
    Route::get('/inventory-management', InventoryManagement::class)->name('inventory-management');

    // Users
    Route::get('/user-management', UserManagement::class)->name('user-management');

    // Communications
    Route::get('/messages', Messages::class)->name('messages');
    Route::get('/messages-support', MessagesSupport::class)->name('messages-support');

    // Reporting
    Route::get('/reports', Reports::class)->name('reports');
    Route::get('/reports-analytics', ReportsAnalytics::class)->name('reports-analytics');

    // System
    Route::get('/settings', Settings::class)->name('settings');
    Route::get('/system-settings', SystemSettings::class)->name('system-settings');
});


// ==========================================
// USER ROUTES (Protected: Must be logged in AND a standard user)
// ==========================================
Route::middleware(['auth', 'role:user'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', function () {
        return view('user-profile.dashboard');
    })->name('dashboard');

    // Future user pages go here...
});
