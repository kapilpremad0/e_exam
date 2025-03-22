<?php


use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LoginController;

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return 'Admin Dashboard';
})->name('dashboard');


