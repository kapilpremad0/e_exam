<?php

use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LavelController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\SubmitResultController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/get-subjects', [SubjectController::class, 'getSubjects'])->name('get.subjects');

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    Route::post('check_login',[LoginController::class,'checkLogin'])->name('check_login');
    Route::get('login',[LoginController::class,'index'])->name('login');
    Route::get('logout',[LoginController::class,'logout'])->name('logout');

    


    Route::middleware(['isAdmin'])->group(function () {

        Route::get('/', [HomeController::class,'index'])->name('dashboard');
        Route::resource('exams',ExamController::class);
        Route::get('exams/subjects-view/{id}',[ExamController::class,'subjects'])->name('exams.subjects');
        Route::get('exams/levels-view/{id}',[ExamController::class,'levels'])->name('exams.levels');

        Route::resource('subjects',SubjectController::class);
        Route::resource('levels',LavelController::class);
        Route::resource('questions',QuestionController::class);
        Route::resource('submit_results',SubmitResultController::class);

        
        
            
    });

});
