<?php

use App\Http\Controllers\Api\V1\PositionController;
use App\Http\Controllers\Api\V1\TokenController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Middleware\TokenUse;
use Illuminate\Support\Facades\Route;

Route::prefix('users')->controller(UserController::class)->group(function () {
    Route::get('', 'index');
    Route::get('/{id}', 'show');
    Route::post('', 'store')->middleware(TokenUse::class);
});

Route::prefix('positions')->controller(PositionController::class)->group(function () {
    Route::get('', 'index');
    Route::get('/{id}', 'show');
});

Route::get('token', TokenController::class);
