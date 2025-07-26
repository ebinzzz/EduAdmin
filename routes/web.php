<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Teacher\TeacherController;

Route::get('/',function (){return view('welcome');})->name('welcome');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/login',[LoginController::class,'loginpage'])->name('login');
Route::post('/login',[LoginController::class,'login']);

Route::post('/logout',[LoginController::class,'logout'])->name('logout');

Route::prefix('Teacher')->group(function () {
    Route::get('/teachermanage', [TeacherController::class, 'teachermanage'])->name('teachermanage');
    Route::get('/addteacher',[TeacherController::class,'addteacher'])->name('addteacher');
Route::post('/store', [TeacherController::class, 'store'])->name('store');
Route::get('/{id}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
Route::delete('/teacher/{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');

    // etc.
});
