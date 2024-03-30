<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::post('/sign-in', [AuthController::class, 'signIn']);
Route::post('/sign-out', [AuthController::class, 'signOut']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
