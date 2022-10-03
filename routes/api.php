<?php

use Illuminate\Http\Request;

Route::middleware(['auth:api'])->group(function () {
    // Route::apiResource('posts', PostController::class);
    Route::apiResource('users', UserController::class);
});
