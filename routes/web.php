<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Public assignments
Route::get('/opdrachten', [AssignmentController::class, 'index'])->name('assignments.index');
Route::get('/opdrachten/{assignment}', [AssignmentController::class, 'show'])->name('assignments.show');

// Auth routes (Breeze)
require __DIR__.'/auth.php';

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Messages (all roles)
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store');
    Route::get('/messages/sent', [MessageController::class, 'sent'])->name('messages.sent');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');

    // Student routes
    Route::middleware(['role:student'])->group(function () {
        Route::get('/student/profile/edit', [StudentProfileController::class, 'edit'])->name('student.profile.edit');
        Route::put('/student/profile', [StudentProfileController::class, 'update'])->name('student.profile.update');
        Route::post('/opdrachten/{assignment}/apply', [ApplicationController::class, 'store'])->name('applications.store');
        Route::get('/student/applications', [ApplicationController::class, 'studentIndex'])->name('student.applications.index');
    });

    // Company routes
    Route::middleware(['role:company'])->group(function () {
        Route::get('/company/profile/edit', [CompanyProfileController::class, 'edit'])->name('company.profile.edit');
        Route::put('/company/profile', [CompanyProfileController::class, 'update'])->name('company.profile.update');
        Route::get('/company/assignments', [AssignmentController::class, 'myAssignments'])->name('company.assignments.index');
        Route::get('/company/assignments/create', [AssignmentController::class, 'create'])->name('company.assignments.create');
        Route::post('/company/assignments', [AssignmentController::class, 'store'])->name('company.assignments.store');
        Route::get('/company/assignments/{assignment}/edit', [AssignmentController::class, 'edit'])->name('company.assignments.edit');
        Route::put('/company/assignments/{assignment}', [AssignmentController::class, 'update'])->name('company.assignments.update');
        Route::delete('/company/assignments/{assignment}', [AssignmentController::class, 'destroy'])->name('company.assignments.destroy');
        Route::get('/company/assignments/{assignment}/applications', [ApplicationController::class, 'companyIndex'])->name('company.applications.index');
        Route::patch('/company/applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('company.applications.status');
    });

    // Admin routes
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::patch('/users/{user}/block', [AdminController::class, 'toggleBlock'])->name('users.block');
        Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
        Route::get('/assignments', [AdminController::class, 'assignments'])->name('assignments');
        Route::delete('/assignments/{assignment}', [AdminController::class, 'destroyAssignment'])->name('assignments.destroy');
    });

    // Profile views (public for logged in users)
    Route::get('/student/{id}/profile', [StudentProfileController::class, 'show'])->name('student.profile.show');
    Route::get('/company/{id}/profile', [CompanyProfileController::class, 'show'])->name('company.profile.show');
});
