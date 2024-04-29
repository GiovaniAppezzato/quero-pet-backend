<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdopterController;
use App\Http\Controllers\Adopter\OrderController;

Route::middleware('auth:sanctum')->group(function (){
    Route::apiResource('adopter', AdopterController::class)->only(['store', 'update']);

    Route::prefix('/adopter')->group(function (){
        Route::apiResource('/orders', AdopterController::class)->only(['index', 'show', 'store', 'destroy']);
        // Route::get('/orders', [OrderController::class, 'index']);
        // Route::get('/orders/{id}', [OrderController::class, 'show']);
        // Route::post('/orders/store', [OrderController::class, 'store']);
        // Route::delete('/orders/delete/{id}', [OrderController::class, 'destroy']);
    });
});
