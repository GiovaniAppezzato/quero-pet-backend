<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OngController;
use App\Http\Controllers\Ong\OrderController;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('/ong')->group(function () {
        Route::post('/store', [OngController::class, 'store'])->name('ong.store');
        Route::put('/update', [OngController::class, 'update'])->name('ong.update');
        Route::get('/orders', [OrderController::class, 'orders'])->name('ong.orders');
        Route::get('/orders/{id}', [OrderController::class, 'getOrder'])->name('ong.order');
    });
});
