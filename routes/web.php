<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\FirstappointmentController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\UleaveController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\SearchController;



Route::middleware('guest')->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'login_action'])->name('login_action');
    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register', [UserController::class, 'register_action'])->name('register_action');
});

Route::middleware('auth')->group(function () {




Route::get('/update_password/{id}', [SchoolController::class, 'update_password'])->name('update_password');
Route::post('/update_password/{id}', [SchoolController::class, 'update_password_action'])->name('update_password_action');




Route::get('/search_teacher', [SearchController::class, 'search_teacher'])->name('search_teacher');
Route::post('/search_teacher', [SearchController::class, 'search_teacher_action'])->name('search_teacher_action');









    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::redirect('/', '/dashboard');
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');



   
        Route::get('/schools', [SchoolController::class, 'schools'])->name('schools');




    Route::get('/new_school', [SchoolController::class, 'new_school'])->name('new_school');
    Route::post('/new_school', [SchoolController::class, 'new_school_action'])->name('new_school_action');

Route::get('/edit_school/{id}', [SchoolController::class, 'edit_school'])->name('edit_school');
    Route::post('/edit_school/{id}', [SchoolController::class, 'edit_school_action'])->name('edit_school_action');
    Route::get('/delete_school/{id}', [SchoolController::class, 'delete_school'])->name('delete_school');




    Route::get('/school/{id}', [SchoolController::class, 'school'])->name('school');
    Route::get('/activities', [ActivityController::class, 'activities'])->name('activities');

    Route::get('/new_establishment/{school_id}', [EstablishmentController::class, 'new_establishment'])->name('new_establishment');
    Route::post('/new_establishment/{school_id}', [EstablishmentController::class, 'new_establishment_action'])->name('new_establishment_action');
    
    Route::get('/edit_establishment/{establishment_id}', [EstablishmentController::class, 'edit_establishment'])->name('edit_establishment');
    Route::post('/edit_establishment/{establishment_id}', [EstablishmentController::class, 'edit_establishment_action'])->name('edit_establishment_action');
    Route::get('/delete_establishment/{establishment_id}', [EstablishmentController::class, 'delete_establishment'])->name('delete_establishment');
    
    Route::get('/new_bank/{school_id}', [BankController::class, 'new_bank'])->name('new_bank');
    Route::post('/new_bank/{school_id}', [BankController::class, 'new_bank_action'])->name('new_bank_action');
    Route::get('/edit_bank/{bank_id}', [BankController::class, 'edit_bank'])->name('edit_bank');
    Route::post('/edit_bank/{bank_id}', [BankController::class, 'edit_bank_action'])->name('edit_bank_action');
    Route::get('/delete_bank/{bank_id}', [BankController::class, 'delete_bank'])->name('delete_bank');



    Route::get('/new_training/{teacher_id}', [TrainingController::class, 'new_training'])->name('new_training');
    Route::post('/new_training/{teacher_id}', [TrainingController::class, 'new_training_action'])->name('new_training_action');
    Route::get('/edit_training/{training_id}', [TrainingController::class, 'edit_training'])->name('edit_training');
    Route::post('/edit_training/{training_id}', [TrainingController::class, 'edit_training_action'])->name('edit_training_action');
    Route::get('/delete_training/{training_id}', [TrainingController::class, 'delete_training'])->name('delete_training');


    Route::get('/new_first_appointment/{teacher_id}', [FirstappointmentController::class, 'new_first_appointment'])->name('new_first_appointment');
    Route::post('/new_first_appointment/{teacher_id}', [FirstappointmentController::class, 'new_first_appointment_action'])->name('new_first_appointment_action');
    Route::get('/edit_first_appointment/{first_appointment_id}', [FirstappointmentController::class, 'edit_first_appointment'])->name('edit_first_appointment');
    Route::post('/edit_first_appointment/{first_appointment_id}', [FirstappointmentController::class, 'edit_first_appointment_action'])->name('edit_first_appointment_action');
    Route::get('/delete_first_appointment/{first_appointment_id}', [FirstappointmentController::class, 'delete_first_appointment'])->name('delete_first_appointment');


    Route::get('/new_promotion/{teacher_id}', [PromotionController::class, 'new_promotion'])->name('new_promotion');
    Route::post('/new_promotion/{teacher_id}', [PromotionController::class, 'new_promotion_action'])->name('new_promotion_action');
    Route::get('/edit_promotion/{promotion_id}', [PromotionController::class, 'edit_promotion'])->name('edit_promotion');
    Route::post('/edit_promotion/{promotion_id}', [PromotionController::class, 'edit_promotion_action'])->name('edit_promotion_action');
    Route::get('/delete_promotion/{promotion_id}', [PromotionController::class, 'delete_promotion'])->name('delete_promotion');


    Route::get('/new_uleave/{teacher_id}', [UleaveController::class, 'new_uleave'])->name('new_uleave');
    Route::post('/new_uleave/{teacher_id}', [UleaveController::class, 'new_uleave_action'])->name('new_uleave_action');
    Route::get('/edit_uleave/{uleave_id}', [UleaveController::class, 'edit_uleave'])->name('edit_uleave');
    Route::post('/edit_uleave/{uleave_id}', [UleaveController::class, 'edit_uleave_action'])->name('edit_uleave_action');
    Route::get('/delete_uleave/{uleave_id}', [UleaveController::class, 'delete_uleave'])->name('delete_uleave');


    Route::get('/new_teacher/{school_id}', [TeacherController::class, 'new_teacher'])->name('new_teacher');
    Route::post('/new_teacher/{school_id}', [TeacherController::class, 'new_teacher_action'])->name('new_teacher_action');

    Route::get('/teacher/{id}', [TeacherController::class, 'teacher'])->name('teacher');
    Route::get('/edit_teacher/{id}', [TeacherController::class, 'edit_teacher'])->name('edit_teacher');
    Route::post('/edit_teacher/{id}', [TeacherController::class, 'edit_teacher_action'])->name('edit_teacher_action');
    Route::get('/delete_teacher/{id}', [TeacherController::class, 'delete_teacher'])->name('delete_teacher');
    Route::get('/restore_teacher/{id}', [TeacherController::class, 'restore_teacher'])->name('restore_teacher');
    Route::get('/transfer_teacher/{id}', [TeacherController::class, 'transfer_teacher'])->name('transfer_teacher');
    Route::post('/transfer_teacher/{id}', [TeacherController::class, 'transfer_teacher_action'])->name('transfer_teacher_action');

    Route::get('/delete_photo/{id}', [TeacherController::class, 'delete_photo'])->name('delete_photo');


    Route::get('/themes/{theme}', [ThemeController::class, 'change_theme'])->name('themes');
});