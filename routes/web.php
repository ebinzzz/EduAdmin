<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Class\ClassManagementController;


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
Route::prefix('Student')->group(function () {
    Route::get('/studentmanage', [StudentController::class, 'studentmanage'])->name('studentmanage');
      Route::get('/addstudent', [StudentController::class, 'addstudent'])->name('addstudent');
});
// Add these to your web.php or api.php
Route::prefix('Class')->group(function() {
    Route::get('/', [ClassManagementController::class, 'index'])->name('class-management.index');
    
    Route::prefix('api')->group(function() {
        Route::get('classes', [ClassManagementController::class, 'getClasses']);
        Route::post('classes', [ClassManagementController::class, 'store']);
        Route::put('classes/{id}', [ClassManagementController::class, 'update']);
        Route::delete('classes/{id}', [ClassManagementController::class, 'destroy']);
        Route::get('classes/export', [ClassManagementController::class, 'exportClasses']);
        
        Route::get('amenities', [ClassManagementController::class, 'getAmenities']);
        Route::post('amenities', [ClassManagementController::class, 'storeAmenity']);
        
        Route::get('maintenance', [ClassManagementController::class, 'getMaintenanceRecords']);
        Route::post('maintenance', [ClassManagementController::class, 'scheduleMaintenance']);
        Route::patch('maintenance/{id}/status', [ClassManagementController::class, 'updateMaintenanceStatus']);
    });
});


// Teacher routes
Route::prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/profile', 'TeacherController@profile')->name('profile');
    Route::get('/classes', 'TeacherController@classes')->name('classes');
    Route::get('/students', 'TeacherController@students')->name('students');
    Route::get('/attendance', 'TeacherController@attendance')->name('attendance');
    Route::get('/timetable', 'TeacherController@timetable')->name('timetable');
    Route::get('/assignments', 'TeacherController@assignments')->name('assignments');
    Route::get('/exams', 'TeacherController@exams')->name('exams');
    Route::get('/grades', 'TeacherController@grades')->name('grades');
    Route::get('/messages', 'TeacherController@messages')->name('messages');
    Route::get('/announcements', 'TeacherController@announcements')->name('announcements');
    Route::get('/parents', 'TeacherController@parents')->name('parents');
    Route::get('/resources', 'TeacherController@resources')->name('resources');
    Route::get('/reports', 'TeacherController@reports')->name('reports');
    Route::get('/help', 'TeacherController@help')->name('help');
});



Route::get('/debug-auth', function() {
    return response()->json([
        'authenticated' => Auth::check(),
        'user_id' => Auth::id(),
        'session_id' => session()->getId(),
    ]);
});