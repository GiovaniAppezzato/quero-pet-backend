<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Customer\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function (){
    Route::apiResource('customer', CustomerController::class)->only(['store', 'update']);

    Route::prefix('/customer')->group(function (){
        Route::apiResource('/orders', OrderController::class)->only(['index', 'show', 'store', 'destroy']);
        // Route::get('/orders', [OrderController::class, 'index']);
        // Route::get('/orders/{id}', [OrderController::class, 'show']);
        // Route::post('/orders/store', [OrderController::class, 'store']);
        // Route::delete('/orders/delete/{id}', [OrderController::class, 'destroy']);
    });
});
