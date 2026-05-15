<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            'name' => 'required|string',
            'slug' => 'required|string'
        ]);

        try {
            DB::beginTransaction();

            Categories::create($validateData);

            DB::commit();

            return response()->json([
                'statusCode' => 201,
                'message' => 'Berhasil menambahkan data!'
            ], 201);
        } catch(Exception $e) {
            DB::rollBack();

            Log::error('Gagal menambahkan data : ' . $e->getMessage());

            return response()->json([
                'statusCode' => 500,
                'message' => "Error, terjadi kesalahan pada sistem!"
            ], 500);
        }
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
            'name' => 'required|string',
            'slug' => 'required|string'
        ]);

        try {
            DB::beginTransaction();

            $categories->update($validateData);

            DB::commit();

            return response()->json([
                'statusCode' => 200,
                'message' => "Berhasil mengubah data!"
            ], 200);
        } catch(Exception $e) {
            DB::rollBack();

            Log::error('Gagal mengubah data : ' . $e->getMessage());

            return response()->json([
                'statusCode' => 500,
                'message' => 'Error, terjadi kesalahan pada sistem!'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $categories)
    {
        try {
            DB::beginTransaction();

            $categories->delete();

            DB::commit();

            return response()->json([
                'statusCode' => 201,
                'message' => "Berhasil menghapus data!"
            ], 201);
        } catch(Exception $e) {
            DB::rollBack();

            Log::error("Gagal menghapus data : " . $e->getMessage());

            return response()->json([
                'statusCode' => 500,
                'message' => 'Error, terjadi kesalahan pada sistem!'
            ], 500);
        }
    }
}
