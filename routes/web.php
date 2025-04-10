<?php

use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LavelController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\SubmitResultController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('term-and-condition',function(){
    $data = Setting::where('key','term_and_condition')->first();
    $name = "Term And Condition";
    return view('page',compact('data','name'));
})->name('term_and_condition');

Route::get('privacy-policy',function(){
    $data = Setting::where('key','privacy_policy')->first();
    $name = "Privacy Policy";
    return view('page',compact('data','name'));
})->name('privacy_policy');


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
        Route::resource('transactions',TransactionController::class);
        Route::resource('users',UserController::class);
        Route::resource('settings',SettingController::class);

        Route::get('settings-term_and_condition',[SettingController::class,'term_and_condition'])->name('settings.term_and_condition');
        Route::get('settings-privacy_policy',[SettingController::class,'privacy_policy'])->name('settings.privacy_policy');
        Route::get('settings-general_setting',[SettingController::class,'general_setting'])->name('settings.general_setting');

        
        
            
    });

});
