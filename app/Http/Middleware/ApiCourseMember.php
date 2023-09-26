<?php

namespace App\Http\Middleware;

use App\Models\Member;
use App\Models\Tutor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiCourseMember
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('api')->user();

        if($user->role == 'admin') {
            return $next($request);
        }

        $tutor = Tutor::where('course_id','=',$request->route('courseid'))
                    ->where('account_id','=',$user->id)->get();

        if($tutor->count() > 0) {
            return $next($request);
        }

        $member = Member::where('course_id','=',$request->route('courseid'))
                    ->where('account_id','=',$user->id)->get()->last();

        if($member == null || $member == [])
        {
            return response()->json([
                'status' => 403,
                'message' => 'User not in course member',
                'data' => 'Please use member credential or contact admin'
            ], 403);
        }

        if ($member->payment_verified != "Success") {
            return response()->json([
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
