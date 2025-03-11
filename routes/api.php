<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('Unauthenticated',function(){
    return response()->json([
        'message' => 'Unauthenticated. Please log in to access this route.',
    ], 401); // 4
})->name('login');

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('forgot_password',[AuthController::class,'forgot_password']);
Route::post('verify_otp',[AuthController::class,'verify_otp']);
Route::post('reset_password',[AuthController::class,'reset_password'])->middleware('auth:api');


Route::get('cities',[AuthController::class,'getCities']);
Route::get('states',[AuthController::class,'getStates']);

Route::apiResource('profile',ProfileController::class)->middleware('auth:api');
