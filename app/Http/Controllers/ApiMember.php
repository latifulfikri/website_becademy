<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
}
