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

class ApiCourse extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('Tutors','Members','Modules', 'Category')->get();

        return (new ApiResponse)->response(
            'Courses data',
            $courses,
            Response::HTTP_OK
        );
    }

    public function myCourse(Request $request) {
        $account = Auth::guard('api')->user();

        $myCourses = Member::with('Course')->where('account_id', $account->id)->get();

        return (new ApiResponse)->response(
            'Courses data',
            $myCourses,
            Response::HTTP_OK
        );
    }

    public function isMember(Request $request){
        $user = Auth::guard('api')->user();
        $course = Course::where('slug','=',$request->route('courseSlug'))->first();

        if($course == null) {
            return (new ApiResponse)->response(
                'Course not found',
                null,
                Response::HTTP_NOT_FOUND
            );
        }

        $isMember = Member::where('account_id', $user->id)->where('course_id', $course->id)->exists();

        if($isMember) {
            return (new ApiResponse)->response(
                'True',
                ['result' => true],
                Response::HTTP_OK
            );
        }else{
            return (new ApiResponse)->response(
                'False',
                ['result' => false],
                Response::HTTP_OK
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        $validation = Validator::make($r->all(),[
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required',
            'min_processor' => 'required',
            'min_storage' => 'required|integer|min:64',
            'min_ram' => 'required|integer|min:4',
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

        try {
            $course = Course::create($validated);
            return (new ApiResponse)->response(
                'Created',
                $course,
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            return (new ApiResponse)->response(
                'Internal server error',
                $th,
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $r)
    {
        $course = Course::with('Tutors','Members','Modules','Category')->where('slug','=',$r->route('courseSlug'))->first();

        if($course == null) {
            return (new ApiResponse)->response(
                'Course not found',
                null,
                Response::HTTP_NOT_FOUND
            );
        }

        return (new ApiResponse)->response(
            'Course data',
            $course,
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r)
    {
        $course = Course::where('slug','=',$r->route('courseSlug'))->first();

        if($course == null) {
            return (new ApiResponse)->response(
                'Course not found',
                null,
                Response::HTTP_NOT_FOUND
            );
        }

        $validation = Validator::make($r->all(),[
            'category_id' => 'exists:categories,id',
            'min_storage' => 'integer|min:64',
            'min_ram' => 'integer|min:4',
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

        if($r->category_id != null)
        {
            $validated['category_id'] = $r->category_id;
        }

        if($r->name != null)
        {
            $validated['name'] = $r->name;
        }

        if($r->desc != null)
        {
            $validated['desc'] = $r->desc;
        }

        if($r->price != null)
        {
            $validated['price'] = $r->price;
        }

        if($r->min_processor != null)
        {
            $validated['min_processor'] = $r->min_processor;
        }

        if($r->min_storage != null)
        {
            $validated['min_storage'] = $r->min_storage;
        }

        if($r->min_ram != null)
        {
            $validated['min_ram'] = $r->min_ram;
        }

        if($r->is_active != null)
        {
            $validated['is_active'] = $r->is_active;
        }

        try {
            $course->update($validated);
            return (new ApiResponse)->response(
                'Updated',
                $course,
                Response::HTTP_OK
            );
        } catch (\Throwable $th) {
            return (new ApiResponse)->response(
                'Internal server error',
                $th,
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function registerMember(Request $r)
    {
        $account = Auth::guard('api')->user();

        $course = Course::where('slug','=',$r->route('courseSlug'))->first();

        if($course == null) {
            return (new ApiResponse)->response(
                'Course not found',
                null,
                Response::HTTP_NOT_FOUND
            );
        }

        $validation = Validator::make($r->all(),[
            'payment_method' => 'required|in:bank,ewallet,direct',
            'payment_picture' => 'required|mimes:jpg,jpeg,png',
        ]);

        if($validation->fails())
        {
            return (new ApiResponse)->response(
                'Not acceptable',
                $validation->errors(),
                Response::HTTP_NOT_ACCEPTABLE
            );
        }

        $member = Member::where('account_id','=',$account->id)
                    ->where('course_id','=',$course->id)
                    ->first();

        if($member != null)
        {
            return (new ApiResponse)->response(
                'Not acceptable',
                [
                    'status' => 'You already registered in this course',
                    'data' => $member
                ],
                Response::HTTP_NOT_ACCEPTABLE
            );
        }

        try {
            if ($path = $r->file('payment_picture')->store('/',['disk' => 'course_payment'])) {
                $newMember = Member::create([
                    'account_id' => $account->id,
                    'course_id' => $course->id,
                    'payment_method' => $r->payment_method,
                    'payment_picture' => $path,
                ]);

                if (!$newMember) {
                    Storage::disk('course_payment')->delete($path);
                    return (new ApiResponse)->response(
                        'Internal server error',
                        null,
                        Response::HTTP_INTERNAL_SERVER_ERROR
                    );
                }

                return (new ApiResponse)->response(
                    'Registered',
                    [
                        'status' => 'Please wait for 1x24 until your course is ready'
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
        } catch (\Throwable $th) {
            return (new ApiResponse)->response(
                'Internal server error',
                $th,
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function registerTutor(Request $r)
    {
        $course = Course::where('slug','=',$r->route('courseSlug'))->first();

        if($course == null) {
            return (new ApiResponse)->response(
                'Course not found',
                null,
                Response::HTTP_NOT_FOUND
            );
        }

        $validation = Validator::make($r->all(),[
            'account_id' => 'required|exists:accounts,id',
        ]);

        if($validation->fails())
        {
            return (new ApiResponse)->response(
                'Not acceptable',
                $validation->errors(),
                Response::HTTP_NOT_ACCEPTABLE
            );
        }

        $tutor = Tutor::where('account_id','=',$r->account_id)
                    ->where('course_id','=',$course->id)
                    ->first();

        if($tutor != null)
        {
            return (new ApiResponse)->response(
                'Not acceptable',
                [
                    'status' => 'That account has been registered in this course',
                    'data' => $tutor
                ],
                Response::HTTP_NOT_ACCEPTABLE
            );
        }

        try {
            $newTutor = Tutor::create([
                'account_id' => $r->account_id,
                'course_id' => $course->id,
            ]);

            return (new ApiResponse)->response(
                'Registered',
                Tutor::with('Account','Course')->find($newTutor->id),
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            return (new ApiResponse)->response(
                'Internal server error',
                $th,
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
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
