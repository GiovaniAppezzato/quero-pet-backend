<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminController;

Route::post('/sign-in', [AuthController::class, 'store']);

// ** This route is only for testing purposes
Route::get('/admins', [AdminController::class, 'index']);

Route::middleware('auth:sanctum')->group(function (){
    Route::delete('/sign-out', [AuthController::class, 'destroy']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
});
