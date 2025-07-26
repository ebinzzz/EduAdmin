<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

Route::get('/',function (){return view('welcome');})->name('welcome');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/login',[LoginController::class,'loginpage'])->name('login');
Route::post('/login',[LoginController::class,'login']);

Route::post('/logout',[LoginController::class,'logout'])->name('logout');
