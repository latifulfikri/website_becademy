<?php

use App\Http\Controllers\ApiAuth;
use App\Http\Controllers\ApiVerification;
use App\Http\Controllers\ApiCategory as Category;
use App\Http\Controllers\ApiCourse as Course;
use App\Http\Controllers\ApiModule as Module;
use App\Http\Controllers\ApiMaterial as Material;
use App\Models\Member;
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

Route::post('/login',[ApiAuth::class, 'login']);

Route::get('/category',[Category::class, 'index']);
Route::get('/category/{categorySlug}',[Category::class, 'show']);
Route::get('/course',[Course::class,'index']);
Route::get('/course/{courseSlug}',[Course::class,'show']);
Route::get('/course/{courseSlug}/module',[Module::class, 'index']);
Route::get('/course/{courseSlug}/module/{moduleSlug}',[Module::class, 'show']);

Route::middleware(['apiJWT'])->group(function(){
    Route::get('logout',[ApiAuth::class, 'logout']);

    Route::middleware(['apiVerified'])->group(function(){
        Route::middleware(['apiAdmin'])->group(function(){
            Route::post('/category',[Category::class, 'store']);
            Route::put('/category/{categorySlug}/update',[Category::class, 'update']);
            Route::post('/course',[Course::class, 'store']);
            Route::put('/course/{courseSlug}/tutor/register',[Course::class, 'registerTutor']);

            Route::get('/members',[Member::class,'index']);
        });

        Route::middleware(['apiVerified','apiCourseAdmin'])->group(function(){
            Route::put('/course/{courseSlug}/update',[Course::class, 'update']);
            Route::post('/course/{courseSlug}/module',[Module::class, 'store']);
            Route::put('/course/{courseSlug}/module/{moduleSlug}',[Module::class, 'update']);
        });

        Route::middleware(['apiVerified','apiCourseMember'])->group(function(){
            Route::get('/course/{courseSlug}/module/{moduleSlug}/material',[Material::class, 'index']);
            Route::get('/course/{courseSlug}/module/{moduleSlug}/material/{materialSlug}',[Material::class, 'show']);
        });

        Route::put('/course/{courseSlug}/member/register',[Course::class, 'registerMember']);
        Route::put('/course/{courseSlug}/is-member',[Course::class, 'isMember']);

        Route::group(['prefix'=> '/my'], function(){
            Route::get('/course',[Course::class,'myCourse']);
            Route::get('/data',[ApiAuth::class,'userLoginData']);
        });
    });
});
