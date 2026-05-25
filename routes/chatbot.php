<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    // Chatbot page
    Route::get('/chatbot', function () {
        return view('pages.chatbot');
    })->name('chatbot');

    // Dashboard with chatbot integration
    Route::get('/dashboard-with-chat', function () {
        return view('pages.dashboard-with-chat');
    })->name('dashboard.chat');
});

// Include n8n API routes if you want to expose chatbot API
// require base_path('routes/n8n.php');
