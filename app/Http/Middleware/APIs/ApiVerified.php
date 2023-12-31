<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class ApiVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('api')->user();
        if (! $user ||
            ($user instanceof MustVerifyEmail &&
            ! $user->hasVerifiedEmail())) {
            return response()->json([
                'status' => 403,
                'message' => 'Account not verified',
                'data' => [
                    'body' => 'Open your email inbox to verify or request new verification email',
                    'url' => 'http://127.0.0.1:8000/api/email/verify/'.$user->id.'/resend'
                ]
            ], 403);
        }

        return $next($request);
    }
}
