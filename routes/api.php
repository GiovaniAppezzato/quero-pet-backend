<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AdopterController;
use App\Http\Controllers\AdminController;

Route::post('/sign-in', [AuthController::class, 'store']);
Route::post('/recover-password', [AuthController::class, 'recoverPassword']);

Route::middleware('auth:sanctum')->group(function (){
    Route::delete('/sign-out', [AuthController::class, 'destroy']);
    Route::get('/show-me', [AuthController::class, 'show']);
    Route::post('/confirm-password', [AuthController::class, 'confirmPassword']);

    Route::apiResource('/pets', PetController::class);
    Route::apiResource('/categories', CategoryController::class)->only('index', 'show');
    Route::apiResource('/adopters', AdopterController::class)->only('index', 'show');
    Route::apiResource('/admins', AdminController::class)->only('index', 'show');
    Route::apiResource('/ongs', AdminController::class)->only('index', 'show');
});

require __DIR__.'/admin.php';
require __DIR__.'/adopter.php';
require __DIR__.'/ong.php';
