<?php

namespace App\Http\Middleware\WEB;

use App\Models\Course;
use App\Models\Member;
use App\Models\Tutor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CourseMember
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

        $tutor = Tutor::where('course_id','=',$request->route('courseid'))
                    ->where('account_id','=',$user->id)->get();

        if($tutor->count() > 0) {
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

        $member = Member::where('course_id','=',$course->id)
                    ->where('account_id','=',$user->id)->get()->last();

        if($member == null || $member == [])
        {
            return response()->view('...',[ //TODO: isi routenya
                'status' => 403,
                'message' => 'User not in course member',
                'data' => 'Please register as a member in course'
            ], 403);
        }

        if ($member->payment_verified != "Success") {
            return response()->view('...',[ //TODO: isi routenya
                'status' => 403,
                'message' => 'Cannot access due payment status',
                'data' => [
                    'payment_status' => $member->payment_verified,
                    'message' => 'please wait 1x24 hours if payment status is in process'
                ]
            ], 403);
        }

        return $next($request);
    }
}
