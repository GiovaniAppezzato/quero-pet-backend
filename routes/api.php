<?php

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CustomerController;

Route::post('/sign-in', [AuthController::class, 'signIn']);
Route::post('/sign-up', [CustomerController::class, 'store']);

Route::middleware('auth:sanctum')->group(function (){
    Route::post('/sign-out', [AuthController::class, 'signOut']);

    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // })->middleware('auth:sanctum');
});