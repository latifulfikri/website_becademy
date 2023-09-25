<?php

namespace App\Http\Middleware;

use App\Models\Tutor;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiCourseAdmin
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

        $tutor = Tutor::where('course_id','=',$request->route()->parameter('courseid'))
                    ->where('account_id','=',$user->id)->get();

        if($tutor->count() <= 0)
        {
            return response()->json([
                'status' => 403,
                'message' => 'User not in course admin',
                'data' => [
                    'courseid' => $request->route()->parameter('courseid'),
                    'account_id' => $user->id
                ]
                // 'data' => 'Please use admin credential or contact developer'
            ], 403);
        }

        return $next($request);
    }
}
