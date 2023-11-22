<?php

use App\Http\Controllers\APIs\ApiVerification;
use App\Http\Controllers\WEB\AuthController as Auth;
use App\Http\Controllers\WEB\CategoryController as Category;
use App\Http\Controllers\WEB\CourseController as Course;
use App\Http\Controllers\WEB\ModuleController as Module;
use App\Http\Controllers\WEB\MaterialController as Material;
use App\Http\Controllers\WEB\MemberController as Member;
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

// Route buat test tampilan doang
Route::get('/', function () {
    return view('HomePage');
});
// Route::get('/course/test', function () {
//     return view('CoursePage');
// });
Route::get('/course/courseSlug/test', function () {
    return view('CourseDetailPage');
});
Route::get('/course/courseSlug/module/moduleSlug/material', function () {
    return view('MaterialPage');
});
//

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

Route::middleware(['web', 'JWT'])->group(function () {
    Route::get('/email/verify', [ApiVerification::class, 'notice'])->name('verification.notice');
    Route::get('/email/verify/resend', [ApiVerification::class, 'send'])->name('verification.send');

    Route::get('logout',[Auth::class, 'logout']);

    Route::middleware(['Verified'])->group(function(){
        Route::middleware(['Admin'])->group(function(){
            Route::post('/category',[Category::class, 'store']);
            Route::put('/category/{categorySlug}/update',[Category::class, 'update']);
            Route::post('/course',[Course::class, 'store']);
            Route::put('/course/{courseSlug}/tutor/register',[Course::class, 'registerTutor']);

            Route::get('/member',[Member::class,'index']);
            Route::get('/member/{id}/detail',[Member::class,'show']);
            Route::put('/member/{id}/verify-payment',[Member::class, 'verifyPayment']);
        });

        Route::middleware(['CourseAdmin'])->group(function(){
            Route::put('/course/{courseSlug}/update',[Course::class, 'update']);
            Route::post('/course/{courseSlug}/module',[Module::class, 'store']);
            Route::put('/course/{courseSlug}/module/{moduleSlug}',[Module::class, 'update']);
            Route::post('/course/{courseSlug}/module/{moduleSlug}/material',[Material::class, 'store']);
            Route::put('/course/{courseSlug}/module/{moduleSlug}/material/{materialSlug}',[Material::class, 'update']);
        });

        Route::middleware(['CourseMember'])->group(function(){
            Route::get('/course/{courseSlug}/module/{moduleSlug}/material',[Material::class, 'index']);
            Route::get('/course/{courseSlug}/module/{moduleSlug}/material/{materialSlug}',[Material::class, 'show']);
        });

        Route::put('/course/{courseSlug}/member/register',[Course::class, 'registerMember']);
        Route::put('/course/{courseSlug}/is-member',[Course::class, 'isMember']);

        Route::group(['prefix'=> '/my'], function(){
            Route::get('/course',[Course::class,'myCourse']);
            Route::get('/data',[Auth::class,'userLoginData']);
        });
    });
});
