<?php

namespace App\Http\Controllers\WEB;
use App\Http\Controllers\Controller;

use App\Models\Material;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $r)
    {
        $module = Module::where('slug',$r->route('moduleSlug'))->first();
        if($module == null) {
            return back()->with('error','Module not found');
        }

        $material = Module::with('Materials')->find($module->id);

        if($material == null) {
            return back()->with('error','Material not found');
        }

        return view('...', ['material'=>$material]); //TODO: isi routenya
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        $module = Module::where('slug',$r->route('moduleSlug'))->first();
        if($module == null) {
            return back()->with('error','Module not found');
        }

        $r->merge(['module_id' => $module->id]);

        $validation = Validator::make($r->all(),[
            'module_id' => 'required|exists:modules,id',
            'name' => 'required',
            'video' => 'required',
            'body' => 'required',
        ]);

        if($validation->fails())
        {
            return back()->withErrors($validation->errors())->withInput();
        }

        $validated = $validation->validated();

        try {
            $material = Material::create($validated);
            return redirect()->route('...')->with('success', 'Material created'); //TODO: isi routenya
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(request $r)
    {
        $material = Material::with('Module')->where('slug',$r->route('materialSlug'))->first();

        if($material == null) {
            return back()->with('error','Material not found');
        }

        return view('...', ['material'=>$material]); //TODO: isi routenya
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r)
    {
        $module = Module::where('slug',$r->route('moduleSlug'))->first();
        if($module == null) {
            return back()->with('error','Module not found');
        }

        $material = Material::with('Module')->find($module->id);

        if($material == null) {
            return back()->with('error','Material not found');
        }

        $validation = Validator::make($r->all(),[
            'module_id' => 'exists:modules,id',
        ]);

        if($validation->fails())
        {
            return back()->withErrors($validation->errors())->withInput();
        }

        $validated = [];

        if($r->name != null)
        {
            $validated['name'] = $r->name;
        }

        if($r->video != null)
        {
            $validated['video'] = $r->video;
        }

        if($r->body != null)
        {
            $validated['body'] = $r->body;
        }

        try {
            $material->update($validated);
            return redirect()->route('...')->with('success','Material updated'); //TODO: isi routenya
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
