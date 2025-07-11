<?php

use App\Jobs\ProcessUserTest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\User\RegisterApiController;

Route::post('/login', [AuthApiController::class, 'login']);
Route::post('/registrar', RegisterApiController::class);

Route::get('/teste', function(){
    ProcessUserTest::dispatch();
});