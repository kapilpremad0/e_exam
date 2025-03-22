<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::post('check_login',[LoginController::class,'checkLogin'])->name('check_login');
    Route::get('login',[LoginController::class,'index'])->name('login');
    Route::get('logout',[LoginController::class,'logout'])->name('logout');


    Route::middleware(['isAdmin'])->group(function () {

        Route::get('/', [HomeController::class,'index'])->name('dashboard');

        // Route::get('jhhh/', [HomeController::class,'index'])->name('dashboard');
        
            
    });

});
