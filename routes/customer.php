<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Customer\OrderController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function (){
    Route::prefix('/customer')->group(function (){
        Route::post('/store', [CustomerController::class, 'store'])->name('customer.store');
        Route::put('/update', [CustomerController::class, 'update'])->name('customer.update');
        Route::get('/orders', [OrderController::class, 'index'])->name('customer.orders');
        Route::get('/orders/{id}', [OrderController::class, 'getOrder'])->name('customer.order');
        Route::post('/orders/pet/{petId}/ong/{ongId}', [OrderController::class, 'store'])->name('customer.order.store');
        Route::delete('/orders/delete/{id}', [OrderController::class, 'destroy'])->name('customer.order.destroy');
    });
});
