<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;

class ApiVerification extends Controller
{
    public function notice(Request $r)
    {
        if ($r->is('api/*')) {
            return (new ApiResponse)->response(
                'Please verify your email or request another email verification',
                [
                    'resend_url' => url('/').'/email/verify/resend',
                ],
                Response::HTTP_OK
            );
        } else {
            return view('auth.verificationNotFound', ['email' => Auth::user()->email]);
        }
    }

    public function verify($id, $hash)
    {
        Auth::loginUsingId($id);
        $user = Account::find($id);
    
        if (! hash_equals($hash,
            sha1($user->password))) {
            return view('auth.verificationFail');
        }

        if ($user->hasVerifiedEmail()) {
            return view('auth.verifiedEmail')->with(['email'=>$user->email]);
        }
    
        $user->markEmailAsVerified();
        event(new Verified($user));
    
        Auth::logout();
    
        return view('auth.verifiedEmail')->with(['email'=>$user->email]);
    }

    public function send(Request $r)
    {
        $id = null;
        if ($r->is('api/*')) {
            $id = Auth::guard('api')->user()->id;
        } else {
            if(Auth::user() == null) {
                return redirect('/login');
            }
            $id = Auth::user()->id;
        }
        
        $user = Account::find($id);

        if ($user->hasVerifiedEmail()) {
            return view('auth.verifiedEmail',['email'=>$user->email]);
        }

        $user->sendEmailVerificationNotification();

        return view('auth.verificationSent',['email'=>$user->email]);
    }

}
