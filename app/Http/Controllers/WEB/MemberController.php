<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function index(){
        $members = Member::with('Account', 'Course')->get();

        return view('...', ['members'=> $members]); //TODO: isi routenya
    }

    public function show(Request $request, string $id){
        $member = Member::with('Course')->find($id);

        if($member == null){
            return back()->with('error','Member not found');
        }

        return view('...',['member'=>$member]); //TODO: isi routenya
    }

    public function verifyPayment(string $id, Request $request){
        $member = Member::with('Course')->find($id);

        if($member == null){
            return back()->with('error','Member not found');
        }

        $validation = Validator::make($request->all(),[
            'payment_verified' => 'required|in:1,2',
        ]);

        if($validation->fails())
        {
            return back()->withErrors($validation->errors())->withInput();
        }

        $validated = [];
        if($request->payment_verified != null){
            $validated['payment_verified'] = $request->payment_verified;
        }

        try {
            $member->update($validated);
            return redirect()->route('...')->with('success','Member updated'); //TODO: isi routenya
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
