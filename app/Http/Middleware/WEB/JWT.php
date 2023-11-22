<?php

namespace App\Http\Middleware\WEB;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class JWT
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            if (!Auth::guard('web')->user()) {
                return response()->view('...',[ //TODO: isi routenya
                    'status' => 403,
                    'message' => 'User not authorized',
                    'data' => 'Please login with your credential'
                ], 403);
            }

            $user = JWTAuth::parseToken()->check();

            if (!$user) {
                return response()->view('...',[
                    'status' => 403,
                    'message' => 'User not authorized',
                    'data' => 'Login expired'
                ], 403);
            }
        } catch (JWTException $e) {
            return response()->view('...',['message' => $e->getMessage()], 500);
        }
        return $next($request);
    }
}
