<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{


    public function index()
    {
        $user = Auth::user();
        
        // Additional safety check
        if (!$user) {
            return redirect()->route('login');
        }
        
        $role = $user->role;
        
        // Redirect to appropriate dashboard based on role
        return match($role) {
            'superadmin', 'admin' => redirect()->route('admin.dashboard'),
            'teacher' => redirect()->route('teacher.dashboard'),
            'student' => redirect()->route('student.dashboard'),
            default => redirect()->route('login')->with('error', 'Invalid user role')
        };
    }

   public function adminDashboard()
    {
        // Check if user is authenticated first
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $user = Auth::user();
        
        // Check if user has admin access
        if (!in_array($user->role, ['superadmin', 'admin'])) {
            abort(403, 'Unauthorized access');
        }
        
        return view('admindashboard', compact('user'));
    }

    public function teacherDashboard()
    {
        $user = Auth::user();
        
        // Check if user is a teacher
        if ($user->role !== 'teacher') {
            abort(403, 'Unauthorized access');
        }
        
        return view('teacherdashboard', compact('user'));
    }

    public function studentDashboard()
    {
        $user = Auth::user();
        
        // Check if user is a student
        if ($user->role !== 'student') {
            abort(403, 'Unauthorized access');
        }
        
        return view('studentdashboard', compact('user'));
    }
}