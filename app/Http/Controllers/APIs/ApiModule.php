<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ApiModule extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $r)
    {
        $course = Course::where("slug", $r->route('courseSlug'))->first();
        if (!$course) {
            return (new ApiResponse)->response(
                'Course not found',
                [],
                Response::HTTP_NOT_FOUND
            );
        }

        $modules = Module::with(['Materials:id,slug,name,module_id'])->where('course_id','=',$course->id)->get();

        return (new ApiResponse)->response(
            'Modules data',
            $modules,
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        $course = Course::where("slug", $r->route('courseSlug'))->first();
        if (!$course) {
            return (new ApiResponse)->response(
                'Course not found',
                [],
                Response::HTTP_NOT_FOUND
            );
        }

        $r->merge(['course_id' => $course->id]);

        $validation = Validator::make($r->all(),[
            'course_id' => 'required|exists:courses,id',
            'name' => 'required',
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
            $module = Module::create($validated);
            return (new ApiResponse)->response(
                'Created',
                $module,
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
    public function show(request $r)
    {
        $module = Module::with(['Materials:id,slug,name,module_id'])->where('slug',$r->route('moduleSlug'))->first();

        if($module == null) {
            return (new ApiResponse)->response(
                'Module not found',
                null,
                Response::HTTP_NOT_FOUND
            );
        }

        return (new ApiResponse)->response(
            'Module data',
            $module,
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r)
    {
        $module = Module::with('Course')->where('slug',$r->route('moduleSlug'))->first();

        if($module == null) {
            return (new ApiResponse)->response(
                'Module not found',
                null,
                Response::HTTP_NOT_FOUND
            );
        }

        $validated = [];

        if($r->name != null)
        {
            $validated['name'] = $r->name;
        }

        try {
            $module->update($validated);
            return (new ApiResponse)->response(
                'Updated',
                $module,
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
