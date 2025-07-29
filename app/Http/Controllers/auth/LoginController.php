<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function loginpage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validate input (no role required in form)
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Prepare credentials (only email and password)
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        // Try to authenticate
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Get the authenticated user and their role from database
            $user = Auth::user();
            $role = $user->role; // Fetch role from users table
            
            // Redirect based on role from database
            return $this->redirectByRole($role);
        }

        // Login failed
        return back()->with('error', 'Invalid credentials')->withInput($request->except('password'));
    }

    /**
     * Redirect user based on their role
     */
    private function redirectByRole($role)
    {
        switch ($role) {
            case 'superadmin':
                return redirect()->route('admin.dashboard');
            case 'teacher':
                return redirect()->route('teacher.dashboard');
            case 'student':
                return redirect()->route('student.dashboard');
            default:
                return redirect()->route('dashboard');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}