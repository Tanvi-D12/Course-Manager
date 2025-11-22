<?php

use App\Http\Controllers\Admin\InstructorController as AdminInstructorController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\User\CourseController as UserCourseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.
|
*/

// Home page
Route::get('/', function () {
    return view('welcome');
});

// Instructor registration (public)
Route::get('/instructor-register', function () {
    return view('user.instructor-register');
});
Route::post('/instructor-register', [AdminInstructorController::class, 'store'])->name('instructors.store');

// User routes (public)
Route::prefix('courses')->group(function () {
    Route::get('/', [UserCourseController::class, 'index'])->name('courses.index');
    Route::get('/{course}', [UserCourseController::class, 'show'])->name('courses.show');
});

// Admin login routes (public)
Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
});

// Admin protected routes
Route::prefix('admin')->middleware('admin.auth')->group(function () {
    
    // Dashboard
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    
    // Instructor management
    Route::resource('instructors', AdminInstructorController::class);
    Route::post('instructors/{instructor}/approve', [AdminInstructorController::class, 'approve'])
        ->name('instructors.approve');

    // Course management
    Route::resource('courses', AdminCourseController::class);

    // Nested lesson routes (under courses)
    Route::resource('courses.lessons', LessonController::class);
});

// Redirect to courses by default
// Route::redirect('/', '/courses');

