<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ApiAuth extends Controller
{
    public function register(Request $r)
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

        if($validation->fails())
        {
            return (new ApiResponse)->response(
                'Not acceptable',
                $validation->errors(),
                Response::HTTP_NOT_ACCEPTABLE
            );
        }

        $validated = $validation->validated();
        $validated['password'] = bcrypt($r->password);

        if ($path = $r->file('picture')->store('/',['disk' => 'account_picture'])) {
            $validated['picture'] = $path;
            $newAccount = Account::create($validated);
            if (!$newAccount) {
                Storage::disk('account_picture')->delete($path);
                return (new ApiResponse)->response(
                    'Internal server error',
                    null,
                    Response::HTTP_INTERNAL_SERVER_ERROR
                );
            }

            $newAccount->sendEmailVerificationNotification();

            return (new ApiResponse)->response(
                'Registered! Check your email inbox to verify your email',
                [
                    'email' => $newAccount->email
                ],
                Response::HTTP_CREATED
            );
        } else {
            return (new ApiResponse)->response(
                'Cannot upload picture',
                null,
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function login(Request $r)
    {
        $validation = Validator::make($r->All(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validation->fails())
        {
            return (new ApiResponse)->response(
                'Not acceptable',
                $validation->errors(),
                Response::HTTP_NOT_ACCEPTABLE
            );
        }

        $validated = $validation->validated();

        $token = null;
        if ($token = Auth::guard('api')->attempt($validated) ) {
            return $this->createNewToken($token);
        } else {
            return (new ApiResponse)->response(
                'Wrong credential',
                [],
                Response::HTTP_NON_AUTHORITATIVE_INFORMATION
            );
        }
    }

    public function logout(Request $r)
    {
        try {
            Auth::guard('api')->logout();
            return (new ApiResponse)->response(
                'Logout',
                null,
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return (new ApiResponse)->response(
                'Fail logout',
                null,
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 360,
        ]);
    }

    public function userNotAuth()
    {
        return (new ApiResponse)->response(
            'User not authorized',
            null,
            Response::HTTP_FORBIDDEN
        );
    }
}
