<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ApiMaterial extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(request $r)
    {
        $material = Module::with('Materials')->find($r->route('moduleid'));

        if($material == null) {
            return (new ApiResponse)->response(
                'Material not found',
                null,
                Response::HTTP_NOT_FOUND
            );
        }

        return (new ApiResponse)->response(
            'Material',
            $material,
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        $r->merge(['module_id' => $r->route('moduleid')]);

        $validation = Validator::make($r->all(),[
            'module_id' => 'required|exists:modules,id',
            'name' => 'required',
            'video' => 'required',
            'body' => 'required',
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
            $material = Material::create($validated);
            return (new ApiResponse)->response(
                'Created',
                $material,
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
        $material = Material::with('Module')->find($r->route('materialid'));

        if($material == null) {
            return (new ApiResponse)->response(
                'Material not found',
                null,
                Response::HTTP_NOT_FOUND
            );
        }

        return (new ApiResponse)->response(
            'Material',
            $material,
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r)
    {
        $material = Material::with('Module')->find($r->route('materialid'));

        if($material == null) {
            return (new ApiResponse)->response(
                'Module not found',
                null,
                Response::HTTP_NOT_FOUND
            );
        }

        $validation = Validator::make($r->all(),[
            'module_id' => 'exists:modules,id',
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

        if($r->module_id != null)
        {
            $validated['module_id'] = $r->module_id;
        }

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
            return (new ApiResponse)->response(
                'Updated',
                $material,
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
