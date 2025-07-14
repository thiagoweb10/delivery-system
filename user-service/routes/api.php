<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthApiController;
use App\Http\Controllers\Api\User\ListApiController;
use App\Http\Controllers\Api\Auth\RegisterApiController;
use App\Http\Controllers\Api\Auth\ResetPasswordApiController;
use App\Http\Controllers\Api\Auth\SendResetLinkApiController;

Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/registrar', RegisterApiController::class);

Route::post('/password/email', [SendResetLinkApiController::class, 'sendLink']);
Route::post('/password/reset', ResetPasswordApiController::class);

Route::middleware(['auth:api', 'check.admin', 'api'])->get('/users', ListApiController::class);
Route::middleware(['auth:api', 'api'])->get('/me', ListApiController::class);