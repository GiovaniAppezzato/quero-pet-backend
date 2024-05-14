<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ong\OngController;
use App\Http\Controllers\Ong\OrderController;

Route::post('/ongs', [OngController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/ongs')->group(function () {
        // Route::apiResource('/orders', OrderController::class)->only('index', 'show', 'update');
    });
});
