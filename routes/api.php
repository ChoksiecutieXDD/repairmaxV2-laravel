<?php

use App\Http\Controllers\Api\TicketController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------|
| API Routes                     |
|--------------------------------|
*/

Route::post('/tickets', [TicketController::class, 'store']);

// N8N Integration Routes
require base_path('routes/n8n.php');
