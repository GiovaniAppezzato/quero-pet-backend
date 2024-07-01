<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Adopter\AdopterController;
use App\Http\Controllers\Adopter\OrderController;

Route::post('/adopters', [AdopterController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    Route::put('/adopters', [AdopterController::class, 'update']);
    Route::post('/adopters/orders', [OrderController::class, 'store']);
    Route::get('/ok', [OrderController::class, 'index']);
});
