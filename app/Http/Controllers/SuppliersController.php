<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Suppliers::all();

        return response()->json([
            'statusCode' => 200,
            'data' => $suppliers
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => "required|string|max:255",
            'contact_person' => "required|string|max:255",
            'phone' => "required|string|max:255",
            'address' => "required|string|max:255"
        ]);

        $suppliers = Suppliers::create($validateData);

        return response()->json([
            'statusCode' => 201,
            'message' => 'Berhasil menambahkan data!',
            'data' => $suppliers
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Suppliers $suppliers)
    {
        return response()->json([
            'statusCode' => 200,
            'data' => $suppliers
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Suppliers $suppliers)
    {
        $validateData = $request->validate([
            'name' => "required|string|max:255",
            'contact_person' => "required|string|max:255",
            'phone' => "required|string|max:255",
            'address' => "required|string|max:255"
        ]);

        $suppliers->update($validateData);

        return response()->json([
            'statusCode' => 201,
            'message' => 'Berhasil mengubah data!'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Suppliers $suppliers)
    {
        $suppliers->delete();

        return response()->json([
            'statusCode' => 201,
            'message' => 'Berhasil menghapus data!'
        ], 201);
    }
}
