<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        try {
            DB::beginTransaction();

            $suppliers = Suppliers::create($validateData);

            DB::commit();

            return response()->json([
                'statusCode' => 201,
                'message' => 'Berhasil menambahkan data!',
                'data' => $suppliers
            ], 201);
        } catch(Exception $e) {
            DB::rollback();

            Log::error("Gagal menambahkan data!" . $e->getMessage());

            return response()->json([
                'statusCode' => 500,
                'message' => 'Gagal menambahkan data!'
            ], 500);
        }
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
    public function update(Request $request, Suppliers $supplier)
    {
        $validateData = $request->validate([
            'name' => "required|string|max:255",
            'contact_person' => "required|string|max:255",
            'phone' => "required|string|max:255",
            'address' => "required|string|max:255"
        ]);

        try {
            DB::beginTransaction();

            $supplier->update($validateData);

            DB::commit();

            return response()->json([
                'statusCode' => 200,
                'message' => 'Berhasil mengubah data!'
            ], 200);
        } catch(Exception $e) {
            DB::rollBack();

            Log::error("Gagal mengubah data : " . $e->getMessage());

            return response()->json([
                'statusCode' => 500,
                'message' => 'Error, terjadi kesalahan pada sistem!'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Suppliers $supplier)
    {
        $supplier->delete();

        return response()->json([
            'statusCode' => 200,
            'message' => 'Berhasil menghapus data!'
        ], 200);
    }
}
