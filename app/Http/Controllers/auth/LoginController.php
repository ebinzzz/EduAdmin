<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginpage()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // ✅ Validate input
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // ✅ Attempt login
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // ✅ Login success
            $request->session()->regenerate(); // Prevent session fixation
            return redirect()->intended('dashboard');
        }

        // ❌ Login failed
        return back()->with('error', 'Invalid email or password')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
