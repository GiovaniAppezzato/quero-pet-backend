<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/store', [AdminController::class, 'store'])->name('admin.store');
    Route::put('/update', [AdminController::class, 'update'])->name('admin.update');
});
