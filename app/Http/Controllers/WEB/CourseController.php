<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Course;
use App\Models\Member;
use App\Models\Tutor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $courses = Course::with('Tutors', 'Members', 'Modules', 'Category')->get();


        return view('...', ['courses' => $courses]); //TODO: isi return viewnya

    }

    public function myCourse(Request $request)
    {

        $account = Auth::guard('web')->user();


        $myCourses = Member::with('Course')->where('account_id', $account->id)->get();


        return view('...', ['myCourses' => $myCourses]); //TODO: isi return viewnya

    }

    public function isMember(Request $request)
    {

        $user = Auth::guard('web')->user();

        $course = Course::where('slug', '=', $request->route('courseSlug'))->first();

        if ($course == null) {

            return back()->with('error', 'Course not found');
        }

        $isMember = Member::where('account_id', $user->id)->where('course_id', $course->id)->exists();

        if ($isMember) {

            return view('...', ['isMember' => true]); //TODO: isi return view

        } else {

            return view('...', ['isMember' => false]); //TODO: isi return view

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        $validation = Validator::make($r->all(), [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'min_processor' => 'required',
            'min_storage' => 'required|integer|min:64',
            'min_ram' => 'required|integer|min:4',
        ]);

        if ($validation->fails()) {

            return back()->withErrors($validation->errors())->withInput();
        }

        $validated = $validation->validated();

        try {
            $course = Course::create($validated);

            return view('...', ['course' => $course])->with('success', 'Course created'); //TODO: isi routenya

        } catch (\Throwable $th) {

            return back()->with('error', 'Internal server error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $r)
    {
        $course = Course::with('Tutors', 'Members', 'Modules', 'Category')->where('slug', '=', $r->route('courseSlug'))->first();

        if ($course == null) {

            return back()->with('error', 'Course not found');
        }


        return view('...', ['course' => $course]); //TODO: isi viewnya

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r)
    {
        $course = Course::where('slug', '=', $r->route('courseSlug'))->first();

        if ($course == null) {

            return back()->with('error', 'Course not found');
        }

        $validation = Validator::make($r->all(), [
            'category_id' => 'exists:categories,id',
            'min_storage' => 'integer|min:64',
            'min_ram' => 'integer|min:4',
        ]);

        if ($validation->fails()) {

            return back()->withErrors($validation->errors())->withInput();
        }

        $validated = [];

        if ($r->category_id != null) {
            $validated['category_id'] = $r->category_id;
        }

        if ($r->name != null) {
            $validated['name'] = $r->name;
        }

        if ($r->desc != null) {
            $validated['desc'] = $r->desc;
        }

        if ($r->price != null) {
            $validated['price'] = $r->price;
        }

        if ($r->min_processor != null) {
            $validated['min_processor'] = $r->min_processor;
        }

        if ($r->min_storage != null) {
            $validated['min_storage'] = $r->min_storage;
        }

        if ($r->min_ram != null) {
            $validated['min_ram'] = $r->min_ram;
        }

        if ($r->is_active != null) {
            $validated['is_active'] = $r->is_active;
        }

        try {
            $course->update($validated);
            return view('...', ['course' => $course])->with('success', 'Course updated');
        } catch (\Throwable $th) {

            return back()->with('error', 'Internal server error');
        }
    }

    public function registerMember(Request $r)
    {
        $account = Auth::guard('web')->user();

        $course = Course::where('slug', '=', $r->route('courseSlug'))->first();

        if ($course == null) {

            return back()->with('error', 'Course not found');
        }

        $validation = Validator::make($r->all(), [
            'payment_method' => 'required|in:bank,ewallet,direct',
            'payment_picture' => 'required|mimes:jpg,jpeg,png',
        ]);

        if ($validation->fails()) {

            return back()->withErrors($validation->errors())->withInput();
        }

        $member = Member::where('account_id', '=', $account->id)
            ->where('course_id', '=', $course->id)
            ->first();

        if ($member != null) {

            return view('...', ['member' => $member])->with('error', 'You already registered in this course'); //TODO: isi routenya
        }

        try {
            if ($path = $r->file('payment_picture')->store('/', ['disk' => 'course_payment'])) {
                $newMember = Member::create([
                    'account_id' => $account->id,
                    'course_id' => $course->id,
                    'payment_method' => $r->payment_method,
                    'payment_picture' => $path,
                ]);

                if (!$newMember) {
                    Storage::disk('course_payment')->delete($path);

                    return back()->with('error', 'Internal server error');
                }

                return redirect()->route('...')->with('success', 'Please wait for 1x24 until your course is ready'); //TODO: isi routenya
            } else {

                return back()->with('error', 'Cannot upload picture');
            }
        } catch (\Throwable $th) {

            return back()->with('Internal server error', $th->getMessage());
        }
    }

    public function registerTutor(Request $r)
    {
        $course = Course::where('slug', '=', $r->route('courseSlug'))->first();

        if ($course == null) {

            return back()->with('error', 'Course not found');
        }

        $validation = Validator::make($r->all(), [
            'account_id' => 'required|exists:accounts,id',
        ]);

        if ($validation->fails()) {

            return back()->withErrors($validation->errors())->withInput();
        }

        $tutor = Tutor::where('account_id', '=', $r->account_id)
            ->where('course_id', '=', $course->id)
            ->first();

        if ($tutor != null) {

            return back()->with('error', 'That account has ben registered as tutor in this course');
        }

        try {
            $newTutor = Tutor::create([
                'account_id' => $r->account_id,
                'course_id' => $course->id,
            ]);

            $tutorID = Tutor::with('Account', 'Course')->find($newTutor->id);
            return view('...', ['tutorID' => $tutorID])->with('success', 'Tutor registered'); //TODO: isi routenya
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
