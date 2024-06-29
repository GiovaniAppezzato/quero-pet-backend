<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ong\OngController;

Route::post('/ongs', [OngController::class, 'store']);

Route::middleware('auth:sanctum')->group(function (){
    Route::put('/ongs', [OngController::class, 'update']);
});
