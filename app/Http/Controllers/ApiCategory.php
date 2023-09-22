<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ApiCategory extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::get();
        return (new ApiResponse)->response(
            'Category data',
            $category,
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        $validation = Validator::make($r->all(),[
            'name' => 'required',
            'icon' => 'required',
            'color' => 'required'
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
            $category = Category::create($validated);
            return (new ApiResponse)->response(
                'Created',
                $category,
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
        $category = Category::find($id);

        if($category == null) {
            return (new ApiResponse)->response(
                'Category not found',
                null,
                Response::HTTP_NOT_FOUND
            );
        }

        return (new ApiResponse)->response(
            'Category data',
            $category,
            Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r, string $id)
    {
        $category = Category::find($id);

        if($category == null) {
            return (new ApiResponse)->response(
                'Category not found',
                null,
                Response::HTTP_NOT_FOUND
            );
        }

        $validated = [];

        if($r->name != null)
        {
            $validated['name'] = $r->name;
        }
        
        if($r->icon != null)
        {
            $validated['icon'] = $r->icon;
        }

        if($r->color != null)
        {
            $validated['color'] = $r->color;
        }

        try {
            $category->update($validated);
            return (new ApiResponse)->response(
                'Updated',
                $category,
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
