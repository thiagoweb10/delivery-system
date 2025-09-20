<?php

use App\Http\Controllers\Api\Auth\AuthApiController;
use App\Http\Controllers\Api\Auth\RegisterApiController;
use App\Http\Controllers\Api\Auth\ResetPasswordApiController;
use App\Http\Controllers\Api\Auth\SendResetLinkApiController;
use App\Http\Controllers\Api\Auth\ValidateResetCodeApiController;
use App\Http\Controllers\Api\User\ListApiController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/registrar', RegisterApiController::class);

Route::post('/password/email', [SendResetLinkApiController::class, 'sendLink']);
Route::post('/password/validate-reset-code', [ValidateResetCodeApiController::class, 'getValidateCode']);
Route::post('/password/reset', ResetPasswordApiController::class);

Route::middleware(['auth:api', 'check.admin', 'api'])->get('/users', ListApiController::class);
Route::middleware(['auth:api', 'api'])->get('/me', [AuthApiController::class, 'me']);
