<?php

use App\Http\Controllers\Api\DeliveryApiController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.jwt', 'auth.client'])->group(function () {
    Route::apiResource('deliveries', DeliveryApiController::class);
});

Route::middleware(['auth.jwt', 'auth.courier'])->group(function () {
    Route::apiResource('deliveries', DeliveryApiController::class);
});
