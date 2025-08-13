<?php

use App\Http\Controllers\Api\CourierApiController;
use App\Http\Controllers\Api\DeliveryApiController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.jwt', 'auth.client'])->group(function () {
    // Route::apiResource('deliveries', DeliveryApiController::class);
});

Route::middleware(['auth.jwt', 'auth.courier'])->group(function () {
    Route::prefix('deliveries')->controller(CourierApiController::class)->group(function () {
        Route::get('available', 'availableDeliveries');
        Route::get('history', 'getDeliveryHistory');
        Route::post('{delivery}/accept', 'acceptDelivery');
        Route::post('{delivery}/release', 'releaseDelivery');
        Route::post('{delivery}/complete', 'completeDelivery');
    });
});
