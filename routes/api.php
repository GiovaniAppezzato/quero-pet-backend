<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;

Route::post('/sign-in', [AuthController::class, 'store']);
Route::apiResource('/categories', CategoryController::class)->only('index', 'show');

Route::middleware('auth:sanctum')->group(function (){
    Route::delete('/sign-out', [AuthController::class, 'destroy']);

    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
});

require __DIR__.'/admin.php';
require __DIR__.'/adopter.php';
require __DIR__.'/ong.php';
