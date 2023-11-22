<?php

namespace App\Http\Middleware\WEB;

use App\Models\Course;
use App\Models\Tutor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CourseAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('web')->user();

        if($user->role == 'admin') {
            return $next($request);
        }

        $course = Course::where('slug',$request->route('courseSlug'))->first();

        if($course == null) {
            return response()->view('...', [ //TODO: isi routenya
                'status' => 403,
                'message' => 'Course not found',
                'data' => ''
            ], 403);
        }

        $tutor = Tutor::where('course_id','=',$course->id)
                    ->where('account_id','=',$user->id)->get();

        if($tutor->count() <= 0)
        {
            return response()->view('...',[ //TODO: isi routenya
                'status' => 403,
                'message' => 'User not in course admin',
                'data' => 'Please use admin credential or contact developer'
            ], 403);
        }

        return $next($request);
    }
}
