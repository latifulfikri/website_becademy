<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;

class ApiVerification extends Controller
{
    public function notice()
    {
        return (new ApiResponse)->response(
            'Please verify your email or request another email verification',
            [
                'url' => 'http://127.0.0.1:8000/email/verify',
                'method' => 'get'
            ],
            Response::HTTP_OK
        );
    }

    public function verify(EmailVerificationRequest $r)
    {
        $user = Account::findOrFail($r->route('id'));

        Auth::login($user);

        if ($user->hasVerifiedEmail()) {
            return view('auth.verifiedEmail')->with(['email'=>$user->email]);
        }

        $user->markEmailAsVerified();
        event(new Verified($user));

        Auth::logout();

        return view('auth.verifiedEmail')->with(['email'=>$user->email]);
    }

    public function send($id)
    {
        $user = Account::findOrFail($id);

        Auth::login($user);

        if ($user->hasVerifiedEmail()) {
            return (new ApiResponse)->response(
                'Your email has ben verified',
                [
                    'email' => $user->email
                ],
                Response::HTTP_NOT_ACCEPTABLE
            );
        }

        $user->sendEmailVerificationNotification();

        Auth::logout();

        return (new ApiResponse)->response(
            'Verification link has been sent to your email',
            [
                'email' => $user->email
            ],
            Response::HTTP_ACCEPTED
        );
    }

}