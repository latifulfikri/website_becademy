<?php

use App\Http\Controllers\ApiAuth;
use App\Http\Controllers\ApiVerification;
use App\Http\Controllers\ApiCategory as Category;
use App\Http\Controllers\ApiCourse as Course;
use App\Http\Controllers\ApiModule as Module;
use App\Http\Controllers\ApiMaterial as Material;
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
Route::get('/course/{courseid}',[Course::class,'show']);
Route::get('/course/{courseid}/module',[Module::class, 'index']);
Route::get('/course/{courseid}/module/{moduleid}',[Module::class, 'show']);

Route::middleware(['apiJWT'])->group(function(){
    Route::get('/email/verify', [ApiVerification::class, 'notice'])->name('verification.notice');
    Route::get('/email/verify/resend', [ApiVerification::class, 'send'])->name('verification.send');
    Route::get('logout',[ApiAuth::class, 'logout']);

    Route::middleware(['apiVerified'])->group(function(){
        Route::middleware(['apiAdmin'])->group(function(){
            Route::post('/category',[Category::class, 'store']);
            Route::put('/category/{category}/update',[Category::class, 'update']);
            Route::post('/course',[Course::class, 'store']);
            Route::put('/course/{courseid}/tutor/register',[Course::class, 'registerTutor']);
        });

        Route::middleware(['apiVerified','apiCourseAdmin'])->group(function(){
            Route::put('/course/{courseid}/update',[Course::class, 'update']);
            Route::post('/course/{courseid}/module',[Module::class, 'store']);
            Route::put('/course/{courseid}/module/{moduleid}',[Module::class, 'update']);
        });

        Route::middleware(['apiVerified','apiCourseMember'])->group(function(){
            Route::get('/course/{courseid}/module/{moduleid}/material',[Material::class, 'index']);
            Route::get('/course/{courseid}/module/{moduleid}/material/{materialid}',[Material::class, 'show']);
        });

        Route::put('/course/{id}/member/register',[Course::class, 'registerMember']);
        Route::get('/course/{courseSlug}/is-member', [Course::class, 'isMember']);
    });
});
