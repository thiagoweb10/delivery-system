<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\User\ListApiController;
use App\Http\Controllers\Api\User\RegisterApiController;

Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/registrar', RegisterApiController::class);

Route::middleware(['auth:api', 'check.admin', 'api'])->get('/users', ListApiController::class);