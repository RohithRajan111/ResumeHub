<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use Illuminate\Notifications\Channels\MailChannel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


// if (!Auth::check()) {
//     return redirect()->route('show.login')->with('error', 'You must be logged in');
// }
// Public routes (login & register)
// Route::get('/login', [UserController::class, 'showlogin'])->name('show.login');
// Route::post('/login', [UserController::class, 'login'])->name('user.login');

// Route::get('/register', [UserController::class, 'showregisterform'])->name('register');
// Route::post('/register', [UserController::class, 'registration'])->name('user.store');

// // Protected routes (require authentication)
// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard', [UserController::class, 'showjobs'])->name('user.dashboard');
//     Route::post('/apply', [UserController::class, 'selectjob'])->name('show.application');

//     Route::get('/application', [UserController::class, 'showapplication'])->name('application.form');
//     Route::post('/application', [UserController::class, 'apply'])->name('user.apply');
// });


// Route::get('/addjobs', function () {
//     return view('admin.addjobs');
// });

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

// Route::get('/admin.dashboard',[AdminController::class,'showapplication'])->name('show.admindashboard');
// Route::get('/admin/jobs', [AdminController::class, 'index'])->name('admin.jobs.index');
// Route::delete('/jobs/{id}', [UserController::class, 'destroy'])->name('jobs.destroy');


//     Route::get('/jobs/create', [AdminController::class, 'create'])->name('jobs.create');
//     Route::post('/jobs/store', [AdminController::class, 'store'])->name('jobs.store');
//     Route::get('/jobs/{job}/edit', [AdminController::class, 'edit'])->name('jobs.edit');
//     Route::post('/jobs/{job}/update', [AdminController::class, 'update'])->name('jobs.update');


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




// Route::get('/jobs/{id}/edit', [UserController::class, 'edit'])->name('jobs.edit');
// Route::put('/jobs/{id}', [UserController::class, 'update'])->name('jobs.update');


// Route::get('/resume/{id}', [AdminController::class, 'viewResume'])->name('admin.view.resume');

Route::post('/adminlogout',[AdminController::class,'adminlogout'])->name('admin.logout');
