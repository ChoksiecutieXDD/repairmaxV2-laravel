<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// Livewire Components
use App\Livewire\Auth\Register;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\ResetPassword;

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
    Route::get('/dashboard', function () {
        return view('admin-profile.dashboard');
    })->name('dashboard');
    Route::get('/user-management', function () {
        return view('admin-profile.user-management');
    })->name('user-management');

    // Future admin pages go here...
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
