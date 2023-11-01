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
}
