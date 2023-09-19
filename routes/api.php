<?php

use App\Http\Controllers\ApiAuth;
use App\Http\Controllers\ApiVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register',[ApiAuth::class, 'register']);
Route::post('/login',[ApiAuth::class, 'login']);

Route::get('/email/verify', [ApiVerification::class, 'notice'])->name('verification.notice');
Route::get('/email/verify/{id}/resend', [ApiVerification::class, 'send'])->name('verification.send');
Route::get('/email/verify/{id}/{hash}', [ApiVerification::class, 'verify'])->name('verification.verify');