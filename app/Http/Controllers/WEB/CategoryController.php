<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $category = Category::get();

        return view('...', ['categories' => $category]); //TODO: Tambah return viewnya

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        $validation = Validator::make($r->all(), [
            'name' => 'required',
            'icon' => 'required',
            'color' => 'required'
        ]);

        if ($validation->fails()) {

            return back()->withErrors($validation->errors())->withInput();
        }

        $validated = $validation->validated();

        try {
            $category = Category::create($validated);

            return view('...', ['category' => $category])->with('success', 'Category created'); //TODO: isi routenya

        } catch (\Throwable $th) {

            return back()->with('error', 'Internal server error');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $r)
    {
        $category = Category::where('slug', '=', $r->route('categorySlug'))->first();

        if ($category == null) {

            return back()->with('error', 'Category not found');
        }


        return view('...', ['category' => $category]); //TODO: isi return viewnya

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r)
    {
        $category = Category::where('slug', '=', $r->route('categorySlug'))->first();

        if ($category == null) {

            return back()->with('error', 'Category not found');
        }

        $validated = [];

        if ($r->name != null) {
            $validated['name'] = $r->name;
        }

        if ($r->icon != null) {
            $validated['icon'] = $r->icon;
        }

        if ($r->color != null) {
            $validated['color'] = $r->color;
        }

        try {
            $category->update($validated);

            return view('...',['category'=>$category])->with('success', 'Category updated'); //TODO: isi routenya

        } catch (\Throwable $th) {

            return back()->with('error', 'Internal server error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $r)
    {
        //
    }
}
