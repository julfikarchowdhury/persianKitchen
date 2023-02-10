<?php

use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\V1\Auth\PassportAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->group(function(){

    Route::post('register', [PassportAuthController::class, 'register']);
    Route::post('login', [PassportAuthController::class, 'login']);
    Route::post('/forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
    Route::post('/verify/pin',[ForgotPasswordController::class, 'verifyPin']);
    Route::post( '/reset-password', [ForgotPasswordController::class, 'resetPassword']);
    Route::get('category', [CategoryController::class, 'categoryDetails']);

    Route::middleware('auth:api')->group(function () {
        Route::post('verify-otp', [PassportAuthController::class, 'verifyOtp']);
        Route::get('get-user', [PassportAuthController::class, 'userInfo']);
        Route::post('change-password',[PassportAuthController::class, 'changePassword']);
        Route::post('logout', [PassportAuthController::class, 'logout']);
    });
});
