<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeComtroller;
use App\Http\Controllers\Api\PaymentController;
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

Route::post('create_order',[PaymentController::class,'createOrder'])->middleware('auth:api');
Route::post('verify_payment',[PaymentController::class,'verifyPayment'])->middleware('auth:api');


Route::get('home',[HomeComtroller::class,'home'])->middleware('auth:api');
Route::get('subject_detail/{id}',[HomeComtroller::class,'subjectDetail'])->middleware('auth:api');
Route::get('level_detail/{id}',[HomeComtroller::class,'levelDetail'])->middleware('auth:api');
Route::post('submit_result',[HomeComtroller::class,'submitResult'])->middleware('auth:api');
Route::get('results',[HomeComtroller::class,'results'])->middleware('auth:api');


Route::get('cities',[AuthController::class,'getCities']);
Route::get('states',[AuthController::class,'getStates']);

Route::apiResource('profile',ProfileController::class)->middleware('auth:api');
