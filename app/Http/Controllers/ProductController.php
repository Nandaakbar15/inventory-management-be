<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Products::with('categories')->get();

        return response()->json([
            'statusCode' => 200,
            'data' => $product
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'category_id'    => 'required|exists:categories,id', // Pastikan ID kategori ada di DB
            'sku'            => 'required|unique:products,sku',  // SKU tidak boleh kembar
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',               // Deskripsi boleh kosong
            'min_stock'      => 'required|integer|min:0',        // Harus angka positif
            'purchase_price' => 'required|numeric|min:0',
            'sell_price'     => 'required|numeric|min:0',
        ]);

        $product = Products::create($validateData);

        return response()->json([
            'statusCode' => 201,
            'message' => "Berhasil menambahkan data!",
            'data' => $product
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
        return response()->json([
            'statusCode' => 200,
            'data' => $product
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
         $validateData = $request->validate([
            'category_id'    => 'required|exists:categories,id', // Pastikan ID kategori ada di DB
            'sku'            => 'required|unique:products,sku',  // SKU tidak boleh kembar
            'name'           => 'required|string|max:255',
            'description'    => 'nullable|string',               // Deskripsi boleh kosong
            'min_stock'      => 'required|integer|min:0',        // Harus angka positif
            'purchase_price' => 'required|numeric|min:0',
            'sell_price'     => 'required|numeric|min:0',
        ]);

        $product->update($validateData);

        return response()->json([
            'statusCode' => 200,
            'message' => "Data berhasil diperbarui"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        $product->delete();

        return response()->json([
            'statusCode' => 201,
            'message' => "Berhasil menghapus data!"
        ], 201);
    }
}
