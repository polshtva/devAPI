<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\HealthController;
use App\Http\Controllers\Api\MetricsController;

Route::middleware(['api'])->group(function () {
    Route::post('/contact', [ContactController::class, 'store']);
    Route::get('/health', HealthController::class);
    Route::get('/metrics', MetricsController::class);
});
