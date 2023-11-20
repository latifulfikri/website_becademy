<?php

use App\Http\Controllers\ApiVerification;
use App\Http\Controllers\AuthController as Auth;
use App\Http\Controllers\CategoryController as Category;
use App\Http\Controllers\CourseController as Course;
use App\Http\Controllers\ModuleController as Module;
use App\Http\Controllers\MaterialController as Material;
use App\Http\Controllers\MemberController as Member;
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

Route::get('/login',[Auth::class,'index']);
Route::post('/login/authenticate',[Auth::class,'login']);

Route::get('register',[Auth::class,'register']);
Route::post('register/submit',[Auth::class,'regist']);

Route::get('/check',[Auth::class,'check']);
Route::get('/email/verify/{id}/{hash}', [ApiVerification::class, 'verify'])->name('verification.verify');

Route::get('/category',[Category::class,'index']);
Route::get('/category/{categorySlug}',[Category::class, 'show']);
Route::get('/course',[Course::class,'index']);
Route::get('/course/{courseSlug}',[Course::class,'show']);
Route::get('/course/{courseSlug}/module',[Module::class, 'index']);
Route::get('/course/{courseSlug}/module/{moduleSlug}',[Module::class, 'show']);

Route::middleware(['web'])->group(function () {
    Route::get('/email/verify', [ApiVerification::class, 'notice'])->name('verification.notice');
    Route::get('/email/verify/resend', [ApiVerification::class, 'send'])->name('verification.send');
});
