<?php

namespace App\Http\Controllers\APIs;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApiResponse extends Controller
{
    public function response($message,$data,$status)
    {
        return Response::json(
            [
                'status' => $status,
                'message' => $message,
                'data' => $data
            ],
            $status
        );
    }
}
