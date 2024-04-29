<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/admins', AdminController::class)->except('destroy');
});
