<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Teacher\TeacherController;

Route::get('/',function (){return view('welcome');})->name('welcome');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login',[LoginController::class,'loginpage'])->name('login');
Route::post('/login',[LoginController::class,'login']);



Route::middleware('auth')->group(function () {
    // Main dashboard (redirects based on role)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Individual role dashboards
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/teacher/dashboard', [DashboardController::class, 'teacherDashboard'])->name('teacher.dashboard');
    Route::get('/student/dashboard', [DashboardController::class, 'studentDashboard'])->name('student.dashboard');
});




Route::post('/logout',[LoginController::class,'logout'])->name('logout');

Route::prefix('Teacher')->group(function () {
    Route::get('/teachermanage', [TeacherController::class, 'teachermanage'])->name('teachermanage');
    Route::get('/addteacher',[TeacherController::class,'addteacher'])->name('addteacher');
    Route::post('/store', [TeacherController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
    Route::put('/{teacher}', [TeacherController::class, 'update'])->name('teacher.update');
    Route::delete('/teacher/{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');
});

Route::get('/debug-auth', function() {
    return response()->json([
        'authenticated' => Auth::check(),
        'user_id' => Auth::id(),
        'session_id' => session()->getId(),
    ]);
});