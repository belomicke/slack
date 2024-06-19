<?php

use App\Http\Controllers\User\GetUserWithEmailExistsStatusController;
use App\Http\Controllers\User\GetUserWithUsernameExistsStatusController;
use App\Http\Controllers\User\GetViewerController;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('viewer', GetViewerController::class);
    });

    Route::get('exists/username', GetUserWithUsernameExistsStatusController::class);
    Route::get('exists/email', GetUserWithEmailExistsStatusController::class);
});
