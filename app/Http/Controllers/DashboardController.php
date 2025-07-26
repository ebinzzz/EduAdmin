<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
{
    $user = Auth::user();

    switch ($user->role) {
        case 'superadmin':
            return view('admindashboard', compact('user'));
        case 'teacher':
            return view('teacherdashboard', compact('user'));
        default:
            return view('studentdashboard', compact('user'));
    }
}
    
}
