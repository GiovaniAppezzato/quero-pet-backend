<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Adopter\AdopterController;

Route::apiResource('/adopters', AdopterController::class)->only('store', 'update');

Route::middleware('auth:sanctum')->group(function (){
    Route::prefix('/adopters')->group(function () {
        Route::apiResource('/orders', OrderController::class)->only('index', 'show', 'store');
    });
});
