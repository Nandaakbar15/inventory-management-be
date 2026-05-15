<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\StockController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/user', fn(Request $request) => $request->user());

    Route::prefix('admin')->group(function () {

        // endpoint users
        Route::prefix('users')->group(function () {
            Route::get('/getAllUsers', [UsersController::class, 'getUsers']);
            Route::get('/detailUsers/{user}', [UsersController::class, 'detailUsers']);
            Route::delete('/deleteUser/{user}', [UsersController::class, 'deleteUsers']);
        });

        // endpoint products
        Route::prefix('products')->group(function () {
            Route::get('/getAllProducts', [ProductController::class, 'index']);
            Route::get('/getProductsById/{product}', [ProductController::class, 'show']);
            Route::post('/createProduct', [ProductController::class, 'store']);
            Route::put('/updateproduct/{product}', [ProductController::class, 'update']);
            Route::delete('/deleteProduct/{product}', [ProductController::class, 'destroy']);
        });

        // endpoint categories
        Route::prefix('categories')->group(function () {
            Route::get('/getAllCategories', [CategoriesController::class, 'index']);
            Route::get('/getCategoriesById/{categories}', [CategoriesController::class, 'show']);
            Route::post('/createCategories', [CategoriesController::class, 'store']);
            Route::put('/updateCategories/{categories}', [CategoriesController::class, 'update']);
            Route::delete('/deleteCategories/{categories}', [CategoriesController::class, 'delete']);
        });

        // endpoint suppliers
        Route::prefix('suppliers')->group(function () {
            Route::get('/getAllSuppliers', [SuppliersController::class, 'index']);
            Route::get('/getSuppliersById/{suppliers}', [SuppliersController::class, 'show']);
            Route::post('/createSupplier', [SuppliersController::class, 'store']);
            Route::put('/updateSupplier/{supplier}', [SuppliersController::class, 'update']);
            Route::delete('/deleteSupplier/{supplier}', [SuppliersController::class, 'destroy']);
        });

        // endpoint stock
        Route::prefix('stock')->group(function () {
            Route::get('/getAllStocks', [StockController::class, 'index']);
            Route::get('/getStockById/{stock}', [StockController::class, 'show']);
            Route::post('/createStock', [StockController::class, 'store']);
            Route::put('/updateStock/{stock}', [StockController::class, 'update']);
            Route::delete('/deleteStock/{stock}', [StockController::class, 'destroy']);
        });

    });
});

Route::post('/login', [LoginController::class, 'login']);
