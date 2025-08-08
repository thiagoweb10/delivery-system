<?php

use App\Http\Controllers\Api\DeliveryApiController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth.jwt'])->group(function () {
    Route::apiResource('deliveries', DeliveryApiController::class);

    Route::get('/pedidos', function () {
        return response()->json(['message' => 'Lista de pedidos']);
    });

    Route::post('/pedidos', function () {
        return response()->json(['message' => 'Pedido criado com sucesso']);
    });
});
