<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use Illuminate\Notifications\Channels\MailChannel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



Route::get('/login', [UserController::class, 'showlogin'])->name('show.login');
Route::post('/login', [UserController::class, 'login'])->name('user.login');

Route::post('/logout',[UserController::class,'logout'])->name('user.logout');


Route::get('/register', [UserController::class, 'showregisterform'])->name('register');
Route::post('/register', [UserController::class, 'registration'])->name('user.store');




Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'showjobs'])->name('user.dashboard');


    //Route::post('/apply', [UserController::class, 'showApplicationForm'])->name('show.application');
    Route::get('/apply/{job}', [UserController::class, 'showApplyForm'])->name('user.apply.form');

    //Route::get('/application', [UserController::class, 'showapplication'])->name('application.form');

    Route::post('/submit-application', [UserController::class, 'apply'])->name('user.apply');
});


Route::get('/adminlogin',[AdminController::class,'showadminlogin'])->name('show.adminlogin');
 Route::post('/adminlogin',[AdminController::class,'adminlogin'])->name('admin.login');



Route::middleware('auth:admin')->group(function () {
    Route::get('/admin.dashboard', [AdminController::class, 'showapplication'])->name('show.admindashboard');
    Route::get('/admin/jobs', [AdminController::class, 'index'])->name('jobs.index');
    Route::delete('/jobs/{id}', [AdminController::class, 'destroy'])->name('jobs.destroy');
    Route::get('/jobs/create', [AdminController::class, 'create'])->name('jobs.create');
    Route::post('/jobs/store', [AdminController::class, 'store'])->name('jobs.store');
    Route::get('/jobs/{job}/edit', [AdminController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{job}/update', [AdminController::class, 'update'])->name('jobs.update');
    Route::get('/resume/{id}', [AdminController::class, 'viewResume'])->name('view.resume');
});



Route::post('/adminlogout',[AdminController::class,'adminlogout'])->name('admin.logout');
