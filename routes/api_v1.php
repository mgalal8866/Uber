<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Api\V1\TripController;
use App\Http\Controllers\Api\V1\CreditController;
use App\Http\Controllers\Api\V1\NotificationController;
use App\Http\Controllers\Api\V1\ExtraServicesController;
use App\Http\Controllers\Api\V1\AuthenticationController;

Route::prefix('auth')->group(function () {
    Route::post('signup', [AuthenticationController::class, 'signup']);
    Route::get('verify_otp', [AuthenticationController::class, 'verify_otp']);
    Route::get('send_otp', [AuthenticationController::class, 'send_otp']);
});
Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('profile', [AuthenticationController::class, 'profile']);
        Route::post('profile/update', [AuthenticationController::class, 'profile_update']);
        Route::get('address', [AuthenticationController::class, 'address']);
        Route::post('address/new', [AuthenticationController::class, 'address_new']);
        Route::post('credit/new', [CreditController::class, 'credit_new']);
        Route::get('credit', [CreditController::class, 'credit_get']);
        Route::get('services', [ExtraServicesController::class, 'services']);
        Route::post('service/choose', [ExtraServicesController::class, 'services_choose']);
        Route::get('notifiction', [NotificationController::class, 'notifi_get']);

    });
    Route::prefix('trip')->group(function () {

        Route::post('price', [TripController::class, 'get_price']);
        Route::post('create', [TripController::class, 'create']);


    });
});
