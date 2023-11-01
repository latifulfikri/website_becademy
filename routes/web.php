<?php

use App\Http\Controllers\ApiVerification;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[AuthController::class,'index']);
Route::post('/login/authenticate',[AuthController::class,'login']);

Route::get('register',[AuthController::class,'register']);
Route::post('register/submit',[AuthController::class,'regist']);

Route::get('/check',[AuthController::class,'check']);
Route::get('/email/verify/{id}/{hash}', [ApiVerification::class, 'verify'])->name('verification.verify');

Route::middleware(['web'])->group(function () {
    Route::get('/email/verify', [ApiVerification::class, 'notice'])->name('verification.notice');
    Route::get('/email/verify/resend', [ApiVerification::class, 'send'])->name('verification.send');
});