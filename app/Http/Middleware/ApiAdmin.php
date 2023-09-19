<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ApiAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('api')->user();
        if($user->role != 'admin')
        {
            return response()->json([
                'status' => 403,
                'message' => 'User not admin',
                'data' => 'Please use admin credential or contact developer'
            ], 403);
        }
        return $next($request);
    }
}
