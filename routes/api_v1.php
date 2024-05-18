<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Api\V1\AuthenticationController;

Route::prefix('auth')->group(function () {
    Route::post('signup', [AuthenticationController::class, 'signup']);
    Route::get('verify_otp', [AuthenticationController::class, 'verify_otp']);
    Route::get('send_otp', [AuthenticationController::class, 'send_otp']);
});
Route::get('calc', [AuthenticationController::class, 'calc']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('profile', [AuthenticationController::class, 'profile']);
        Route::post('profile/update', [AuthenticationController::class, 'profile_update']);
        Route::get('address', [AuthenticationController::class, 'address']);
        Route::post('address/new', [AuthenticationController::class, 'address_new']);
    });
});
