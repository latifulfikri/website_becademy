<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        Redirect::setIntendedUrl(url()->previous());
        return view("auth.login");
    }

    public function login(Request $r)
    {
        $validation = Validator::make($r->All(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $validated = $validation->validated();

        if (Auth::attempt($validated)) {
            return redirect('/');
        } else {
            return redirect('/login')->with(['error'=>'Wrong credential']);
        }
    }

    public function register()
    {
        Redirect::setIntendedUrl(url()->previous());
        return view("auth.register");
    }

    public function regist(Request $r)
    {
        $messages = [
            'same' => 'The :attribute and :other must match.',
            'in' => 'The :attribute must be one of the following types: :values',
            'unique' => 'The :attribute is already registered',
        ];

        $validation = Validator::make($r->all(), [
            'name' => 'required',
            'email' => 'required|unique:accounts,email|email',
            'picture' => 'required|mimes:jpg,jpeg,png',
            'password' => 'required|confirmed|min:8',
            'gender' => 'required|in:Male,Female',
            'school' => 'required',
            'degree' => 'required',
            'field_of_study' => 'required',
        ],$messages);

        $validated = $validation->validated();
        $validated['password'] = bcrypt($r->password);

        if ($path = $r->file('picture')->store('/',['disk' => 'account_picture'])) {
            $validated['picture'] = $path;
            $newAccount = Account::create($validated);
            if (!$newAccount) {
                Storage::disk('account_picture')->delete($path);
                return redirect('/register')->with(['error'=> 'Internal server error']);
            }
            Auth::attempt([
                'email'=> $validated['email'],
                'password'=> $validated['password'],
            ]);
            $newAccount->sendEmailVerificationNotification();
            return view('auth.verificationSent',['email'=>$newAccount->email]);
        } else {
            return redirect('/register')->with(['error'=> 'Cannot upload picture']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function check()
    {
        $user = Auth::user();
        dd($user);
    }
}
