<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Publieke vacatures
Route::get('/vacatures', [JobController::class, 'index'])->name('jobs.index');
Route::get('/vacatures/{job}', [JobController::class, 'show'])->name('jobs.show');

// Auth routes (Breeze)
require __DIR__.'/auth.php';

// Ingelogde routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Berichten (alle rollen)
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/sent', [MessageController::class, 'sent'])->name('messages.sent');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');

    // Student routes
    Route::middleware(['role:student'])->group(function () {
        Route::get('/student/profile/edit', [StudentProfileController::class, 'edit'])->name('student.profile.edit');
        Route::put('/student/profile', [StudentProfileController::class, 'update'])->name('student.profile.update');
        Route::post('/vacatures/{job}/apply', [ApplicationController::class, 'store'])->name('applications.store');
        Route::get('/student/applications', [ApplicationController::class, 'studentIndex'])->name('student.applications.index');
    });

    // Bedrijf routes
    Route::middleware(['role:company'])->group(function () {
        Route::get('/company/profile/edit', [CompanyProfileController::class, 'edit'])->name('company.profile.edit');
        Route::put('/company/profile', [CompanyProfileController::class, 'update'])->name('company.profile.update');
        Route::get('/company/jobs', [JobController::class, 'myJobs'])->name('company.jobs.index');
        Route::get('/company/jobs/create', [JobController::class, 'create'])->name('company.jobs.create');
        Route::post('/company/jobs', [JobController::class, 'store'])->name('company.jobs.store');
        Route::get('/company/jobs/{job}/edit', [JobController::class, 'edit'])->name('company.jobs.edit');
        Route::put('/company/jobs/{job}', [JobController::class, 'update'])->name('company.jobs.update');
        Route::delete('/company/jobs/{job}', [JobController::class, 'destroy'])->name('company.jobs.destroy');
        Route::get('/company/jobs/{job}/applications', [ApplicationController::class, 'companyIndex'])->name('company.applications.index');
        Route::patch('/company/applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('company.applications.status');
    });

    // Admin routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::patch('/users/{user}/block', [AdminController::class, 'toggleBlock'])->name('users.block');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::get('/jobs', [AdminController::class, 'jobs'])->name('jobs');
        Route::delete('/jobs/{job}', [AdminController::class, 'destroyJob'])->name('jobs.destroy');
    });

    // Profiel weergave
    Route::get('/student/{id}/profile', [StudentProfileController::class, 'show'])->name('student.profile.show');
    Route::get('/company/{id}/profile', [CompanyProfileController::class, 'show'])->name('company.profile.show');
});
