<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Adopter\AdopterController;

Route::post('/adopters', [AdopterController::class, 'store']);

Route::middleware('auth:sanctum')->group(function (){
    Route::put('/adopters', [AdopterController::class, 'update']);
});
