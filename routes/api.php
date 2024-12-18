<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

Route::get('/country', [ApiController::class, 'daerah']);
Route::get('/category', [ApiController::class, 'category']);
Route::get('/message', [ApiController::class, 'message']);
Route::post('/send', [ApiController::class, 'send']);
