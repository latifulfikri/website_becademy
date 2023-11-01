<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ApiMember extends Controller
{
    public function index(){
        $members = Member::with('Account', 'Course')->get();

        return (new ApiResponse)->response(
            'Members',
            $members,
            Response::HTTP_OK
        );
    }

    public function show(Request $request, string $id){
        $member = Member::with('Course')->find($id);

        if($member == null){
            return (new ApiResponse)->response(
                'Member not found',
                null,
                Response::HTTP_NOT_FOUND
            );
        }

        return (new ApiResponse)->response(
            'Member data',
            $member,
            Response::HTTP_OK
        );
    }

    public function verifyPayment(string $id, Request $request){
        $member = Member::with('Course')->find($id);

        if($member == null){
            return (new ApiResponse)->response(
                'Member not found',
                null,
                Response::HTTP_NOT_FOUND
            );
        }

        $validation = Validator::make($request->all(),[
            'payment_verified' => 'required|in:1,2',
        ]);

        if($validation->fails())
        {
            return (new ApiResponse)->response(
                'Not acceptable',
                $validation->errors(),
                Response::HTTP_NOT_ACCEPTABLE
            );
        }

        $validated = [];
        if($request->payment_method != null){
            $validated['payment_method'] = $request->payment_method;
        }

        try {
            $member->update($validated);
            return (new ApiResponse)->response(
                'Updated',
                $member,
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return (new ApiResponse)->response(
                'Internal server error',
                $th->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
