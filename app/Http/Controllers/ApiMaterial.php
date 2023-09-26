<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
