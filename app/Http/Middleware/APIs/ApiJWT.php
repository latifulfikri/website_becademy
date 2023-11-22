<?php

namespace App\Http\Middleware\APIs;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class ApiJWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if (!Auth::guard('api')->user()) {
                return response()->json([
                    'status' => 403,
                    'message' => 'User not authorized',
                    'data' => 'Please login with your credential'
                ], 403);
            }

            $user = JWTAuth::parseToken()->check();

            if (!$user) {
                return response()->json([
                    'status' => 403,
                    'message' => 'User not authorized',
                    'data' => 'Login expired'
                ], 403);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return $next($request);
    }
}
