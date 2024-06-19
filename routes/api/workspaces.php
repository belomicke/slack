<?php

use App\Http\Controllers\Workspace\CreateWorkspaceController;
use App\Http\Controllers\Workspace\GetMyWorkspacesController;
use Illuminate\Support\Facades\Route;

Route::prefix('workspaces')->middleware('auth:sanctum')->group(function () {
    Route::get('', GetMyWorkspacesController::class);
    Route::post('', CreateWorkspaceController::class);
});
