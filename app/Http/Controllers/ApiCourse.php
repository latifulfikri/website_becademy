<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ApiCourse extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::with('Tutors','Members','Modules')->get();

        return (new ApiResponse)->response(
            'Courses data',
            $courses,
            Response::HTTP_OK
        );
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
    public function show(string $id)
    {
        $course = Course::with('Tutors','Members','Modules')->find($id);

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
    public function update(Request $r, string $id)
    {
        $course = Course::find($id);

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
