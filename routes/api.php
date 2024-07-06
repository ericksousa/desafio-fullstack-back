<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Category\CategoryController;
use App\Http\Controllers\API\Product\ProductController;

Route::controller(AuthController::class)->group(function() {
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group(function() {
    Route::resource('category', CategoryController::class);

    Route::resource('product', ProductController::class);
});

