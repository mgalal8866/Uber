<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Api\V1\AuthenticationController;

Route::prefix('auth')->group(function () {


    Route::post('signup', [AuthenticationController::class, 'signup']);
    Route::get('verify_otp', [AuthenticationController::class, 'verify_otp']);
    Route::get('send_otp'  , [AuthenticationController::class, 'send_otp']);
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('check_otp', function(){
            return 'Success';
        });
    });
});
