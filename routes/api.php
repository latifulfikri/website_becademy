<?php

use App\Http\Controllers\ApiAuth;
use App\Http\Controllers\ApiVerification;
use App\Http\Controllers\ApiCategory as Category;
use App\Http\Controllers\ApiCourse as Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

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

Route::get('/email/verify/{id}/{hash}', [ApiVerification::class, 'verify'])->name('verification.verify');

Route::get('/category',[Category::class, 'index']);
Route::get('/category/{id}',[Category::class, 'show']);
Route::get('/course',[Course::class,'index']);
Route::get('/course/{id}',[Course::class,'show']);

Route::middleware(['apiJWT'])->group(function(){
    Route::get('/email/verify', [ApiVerification::class, 'notice'])->name('verification.notice');
    Route::get('/email/verify/resend', [ApiVerification::class, 'send'])->name('verification.send');
    Route::get('logout',[ApiAuth::class, 'logout']);
    
    Route::middleware(['apiVerified','apiAdmin'])->group(function(){
        Route::post('/category',[Category::class, 'store']);
        Route::put('/category/{id}/update',[Category::class, 'update']);
        Route::post('/course',[Course::class, 'store']);
        Route::put('/course/{id}/update',[Course::class, 'update']);
    });
});