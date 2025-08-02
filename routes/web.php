<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Class\ClassManagementController;
use App\Http\Controllers\Student\StudentViewController;

// ============================================================================
// PUBLIC ROUTES (No authentication required)
// ============================================================================

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'loginpage'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ============================================================================
// AUTHENTICATED ROUTES (Basic authentication required)
// ============================================================================

Route::middleware('auth')->group(function () {
    // Main dashboard (redirects based on role)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Individual role dashboards
    Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/teacher/dashboard', [DashboardController::class, 'teacherDashboard'])->name('teacher.dashboard');
    Route::get('/student/dashboard', [DashboardController::class, 'studentDashboard'])->name('student.dashboard');
});

// ============================================================================
// SUPERADMIN ONLY ROUTES
// ============================================================================

// Teacher Management - Only SuperAdmin can manage teachers
Route::middleware(['auth', 'role:superadmin'])->prefix('Teacher')->group(function () {
    Route::get('/teachermanage', [TeacherController::class, 'teachermanage'])->name('teachermanage');
    Route::get('/addteacher', [TeacherController::class, 'addteacher'])->name('addteacher');
    Route::post('/store', [TeacherController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
    Route::put('/{teacher}', [TeacherController::class, 'update'])->name('teacher.update');
    Route::delete('/teacher/{id}', [TeacherController::class, 'destroy'])->name('teacher.destroy');
});

// ============================================================================
// SUPERADMIN & TEACHER ROUTES (Both can access)
// ============================================================================

// Student Management - SuperAdmin and Teachers can access
Route::middleware(['auth', 'role:superadmin,teacher'])->prefix('Student')->group(function () {
    Route::get('/', [StudentViewController::class, 'index'])->name('index');
    Route::get('/studentmanage', [StudentController::class, 'studentmanage'])->name('studentmanage');
    Route::get('/addstudent', [StudentController::class, 'addstudent'])->name('addstudent');
    Route::post('/createstudent', [StudentController::class, 'store'])->name('create.student');
    Route::get('/status', [StudentController::class, 'status'])->name('student.status');
    Route::post('/preview', [StudentController::class, 'preview'])->name('student.preview');
    Route::post('/confirm-create', [StudentController::class, 'confirmCreate'])->name('student.confirm.create');
    
    Route::get('/class/{className}/sections', [StudentViewController::class, 'showSections'])->name('sections');
    Route::get('/section/{classId}/students', [StudentViewController::class, 'showStudents'])->name('show');
    Route::get('/api/section/{classId}/students', [StudentViewController::class, 'getStudentsJson'])->name('api.students');
    Route::get('/{id}/biodata', [StudentController::class, 'showBiodata'])->name('bio');    
    
    // Student Editing - Only SuperAdmin can edit student details
    Route::middleware('role:superadmin')->group(function () {
        Route::get('/admin/students/{student}/edit', [StudentController::class, 'viewUpdateForm'])->name('students.edit');
        Route::put('/admin/students/{student}', [StudentController::class, 'update'])->name('update.student');
    });
});

// Class Management - SuperAdmin and Teachers can access
Route::middleware(['auth', 'role:superadmin,teacher'])->prefix('Class')->group(function () {
    // View routes - both can access
    Route::get('/', [ClassManagementController::class, 'index'])->name('class-management.index');
    Route::get('classes', [ClassManagementController::class, 'getClasses']);
    Route::get('classes', [ClassManagementController::class, 'showform'])->name('classes.create');
    Route::get('classes/export', [ClassManagementController::class, 'exportClasses']);
    Route::get('amenities', [ClassManagementController::class, 'getAmenities']);
    Route::get('maintenance', [ClassManagementController::class, 'getMaintenanceRecords']);
    
    // Modification routes - Only SuperAdmin can create/edit/delete
    Route::middleware('role:superadmin')->group(function () {
        Route::post('classes', [ClassManagementController::class, 'store'])->name('create.class');
        Route::get('/classes/{id}/edit', [ClassManagementController::class, 'edit'])->name('classes.edit');
        Route::put('/classes/{id}', [ClassManagementController::class, 'update'])->name('classes.update');
        Route::delete('classes/{id}', [ClassManagementController::class, 'destroy']);
        Route::post('amenities', [ClassManagementController::class, 'storeAmenity']);
        Route::post('maintenance', [ClassManagementController::class, 'scheduleMaintenance']);
        Route::patch('maintenance/{id}/status', [ClassManagementController::class, 'updateMaintenanceStatus']);
    });
});

// Teacher-specific functionality - SuperAdmin and Teachers can access
Route::middleware(['auth', 'role:superadmin,teacher'])->prefix('teacher')->name('teacher.')->group(function () {
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

// ============================================================================
// DEBUG ROUTES (Remove in production)
// ============================================================================

Route::get('/debug-auth', function() {
    return response()->json([
        'authenticated' => Auth::check(),
        'user_id' => Auth::id(),
        'user_role' => Auth::user()->role ?? 'No role',
        'session_id' => session()->getId(),
    ]);
});