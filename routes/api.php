<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\TimesheetController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);


    Route::prefix('attributes')->group(function () {
        Route::post('create', [AttributeController::class, 'create']);
        Route::patch('{attribute}', [AttributeController::class, 'update']);
    });

    Route::apiResource('timesheets', TimesheetController::class);
});


