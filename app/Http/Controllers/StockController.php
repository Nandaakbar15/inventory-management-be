<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stock = Stock::with('product')->get();

        return response()->json([
            'statusCode' => 200,
            'data' => $stock
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer',
            'location' => 'required|string'
        ]);

        try {
            DB::beginTransaction();

            $stock = Stock::create($validateData);

            DB::commit();

            return response()->json([
                'statusCode' => 201,
                'message' => 'Berhasil menambahkan data!',
                'data' => $stock
            ], 201);
        } catch(Exception $e) {
            DB::rollBack();

            Log::error('Gagal menambahkan data : ' . $e->getMessage());

            return response()->json([
                'statusCode' => 500,
                'message' => 'Error, terjadi kesalahan pada sistem!'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        return response()->json([
            'statusCode' => 200,
            'data' => $stock
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        try {
            DB::beginTransaction();

            $stock->delete();

            DB::commit();

            return response()->json([
                'statusCode' => 201,
                'message' => 'Berhasil menghapus data!'
            ], 201);
        } catch(Exception $e) {
            DB::rollback();

            Log::error("Gagal menghapus data : " . $e->getMessage());

            return response()->json([
                'statusCode' => 500,
                'message' => 'Error, terjadi kesalahan pada sistem!'
            ], 500);
        }
    }
}
