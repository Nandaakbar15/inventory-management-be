<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categories::all();

        return response()->json([
            'statusCode' => 200,
            'data' => $categories
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'slug' => 'required'
        ]);

        Categories::create($validateData);

        return response()->json([
            'statusCode' => 201,
            'message' => 'Berhasil menambahkan data!'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        return response()->json([
            'statusCode' => 200,
            'data' => $categories,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categories $categories)
    {
        $validateData = $request->validate([
            'name' => 'required',
            'slug' => 'required'
        ]);

        $categories->update($validateData);

        return response()->json([
            'statusCode' => 200,
            'message' => "Berhasil mengubah data!"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $categories)
    {
        $categories->delete();

        return response()->json([
            'statusCode' => 201,
            'message' => "Berhasil menghapus data!"
        ], 201);
    }
}
