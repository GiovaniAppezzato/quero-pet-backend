<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OngController;
use App\Http\Controllers\Ong\OrderController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('ong', OngController::class)->only(['store', 'update']);
    Route::prefix('/ong')->group(function () {
        Route::apiResource('/orders', OrderController::class)->only(['index', 'show']);
        // Route::get('/orders', [OrderController::class, 'index']);
        // Route::get('/orders/{id}', [OrderController::class, 'show']);
    });
});
