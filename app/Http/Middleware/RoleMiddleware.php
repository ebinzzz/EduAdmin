<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  ...$roles
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();
        
        // Check if user has any of the required roles
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Redirect based on user role if they don't have access
        switch ($user->role) {
            case 'teacher':
                return redirect()->route('teacher.dashboard')->with('error', 'Access denied. You do not have permission to access this resource.');
            case 'student':
                return redirect()->route('student.dashboard')->with('error', 'Access denied. You do not have permission to access this resource.');
            case 'superadmin':
                return redirect()->route('admin.dashboard')->with('error', 'Access denied. You do not have permission to access this resource.');
            default:
                return redirect()->route('dashboard')->with('error', 'Access denied. You do not have permission to access this resource.');
        }
    }
}