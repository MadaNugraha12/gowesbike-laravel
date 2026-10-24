<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;


/*
|--------------------------------------------------------------------------
| Public API
|--------------------------------------------------------------------------
*/

// Login API
Route::post('/login', [AuthController::class, 'login']);


/*
|--------------------------------------------------------------------------
| Protected API
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // Daftar produk
    Route::get('/products', [ProductController::class, 'index']);

    // Logout API
    Route::post('/logout', [AuthController::class, 'logout']);

});