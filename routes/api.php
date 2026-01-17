<?php

use App\Http\Controllers\TelegramAuthController;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/telegram/generate', [TelegramAuthController::class, 'generate']);
});
