<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cookie;
use App\Http\Controllers\Api\V1\CarController;
use App\Http\Controllers\Api\V1\TripController;
use App\Http\Controllers\Api\V1\CreditController;
use App\Http\Controllers\Api\V1\DriverController;
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
        Route::get('{trip}/start', [TripController::class, 'start']);
        Route::post('{trip}/accept', [TripController::class, 'accept']);
        Route::get('{trip}/end', [TripController::class, 'end']);
        Route::post('{trip}/location', [TripController::class, 'location']);
    });
});

Route::prefix('driver')->group(function () {
    Route::post('registration', [DriverController::class, 'registration']);
    Route::get('services', [DriverController::class, 'services']);
    Route::get('set/services', [DriverController::class, 'set_services']);
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('status_online', [DriverController::class, 'status_online']);
    });
});
Route::prefix('car')->group(function () {
    Route::get('brands', [CarController::class, 'brands']);
    Route::get('category', [CarController::class, 'category']);
    Route::get('model', [CarController::class, 'model']);
});
