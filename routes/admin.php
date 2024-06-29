<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::post('/admins', [AdminController::class, 'store']);

Route::middleware('auth:sanctum')->group(function (){
    Route::put('/admins', [AdminController::class, 'update']);
});
