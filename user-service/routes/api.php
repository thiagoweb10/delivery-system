<?php

use App\Http\Controllers\Api\AuthApiController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthApiController::class, 'login']);

Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', fn () => response()->json(['msg' => 'Área do Admin']));
});

Route::middleware(['auth:api', 'role:courier'])->group(function () {
    Route::get('/courier/pedidos', fn () => response()->json(['msg' => 'Pedidos para Entregador']));
});

Route::middleware(['auth:api', 'role:customer'])->group(function () {
    Route::get('/customer/meus-pedidos', fn () => response()->json(['msg' => 'Pedidos do Cliente']));
});