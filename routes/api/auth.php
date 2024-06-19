<?php

use App\Http\Controllers\Auth\CreateAccessToken;
use App\Http\Controllers\Auth\CreateAccountController;
use App\Http\Controllers\Auth\DeleteAccessTokenController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('create-account', CreateAccountController::class);
    Route::post('create-access-token', CreateAccessToken::class);

    Route::middleware('auth:sanctum')->group(function () {
        Route::delete('delete-access-token', DeleteAccessTokenController::class);
    });
});
