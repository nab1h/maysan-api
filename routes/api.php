<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClinicDataController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\PaymentController;


// Start authantication ===========
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/reservation-form', [ReservationController::class, 'formOptions']);
Route::post('/reservations', [ReservationController::class, 'store']);
Route::post('/payment/process', [PaymentController::class, 'paymentProcess']);

Route::get('/locations', [ClinicDataController::class, 'locations']);
Route::get('/branches', [ClinicDataController::class, 'branches']);
Route::get('/departments', [ClinicDataController::class, 'departments']);
Route::get('/services', [ClinicDataController::class, 'services']);
Route::get('/doctors', [ClinicDataController::class, 'doctors']);
Route::get('/offers', [ClinicDataController::class, 'offers']);


// End authantication =============

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
