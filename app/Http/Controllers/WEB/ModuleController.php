<?php

namespace App\Http\Controllers\WEB;
use App\Http\Controllers\Controller;

use App\Models\Course;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $r)
    {
        $course = Course::where("slug", $r->route('courseSlug'))->first();
        if (!$course) {
            return back()->with('error', 'Course not found');
        }

        $modules = Module::with(['Materials:id,slug,name,module_id'])->where('course_id','=',$course->id)->get();

        return view('...', ['modules'=> $modules]); //TODO: isi routenya
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        $course = Course::where("slug", $r->route('courseSlug'))->first();
        if (!$course) {
            return back()->with('error', 'Course not found');
        }

        $r->merge(['course_id' => $course->id]);

        $validation = Validator::make($r->all(),[
            'course_id' => 'required|exists:courses,id',
            'name' => 'required',
        ]);

        if($validation->fails())
        {
            return back()->withErrors($validation->errors())->withInput();
        }

        $validated = $validation->validated();

        try {
            $module = Module::create($validated);
            return redirect()->route('...')->with('success','Module created'); //TODO: isi routenya
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(request $r)
    {
        $module = Module::with(['Materials:id,slug,name,module_id'])->where('slug',$r->route('moduleSlug'))->first();

        if($module == null) {
            return back()->with('error', 'Module not found');
        }

        return view('...',['module'=>$module]); //TODO: isi routenya
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r)
    {
        $module = Module::with('Course')->where('slug',$r->route('moduleSlug'))->first();

        if($module == null) {
            return back()->with('error', 'Module not found');
        }

        $validated = [];

        if($r->name != null)
        {
            $validated['name'] = $r->name;
        }

        try {
            $module->update($validated);
            return redirect()->route('...')->with('success','Module updated'); //TODO: isi routenya
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
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
