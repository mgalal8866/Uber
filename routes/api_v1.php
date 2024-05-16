<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Api\V1\AuthenticationController;

Route::prefix('auth')->group(function () {


    Route::post('signup', [AuthenticationController::class, 'signup']);
    Route::get('login', [AuthenticationController::class, 'login']);
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('check_otp', function(){
            return 'Success';
        });
    });
});
