<?php

namespace App\Http\Controllers\Student;
//use App\Models\Teacher;
//use App\Mail\TeacherProfileUpdated; // Make sure this Mailable exists
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash; // Missing import!
use Illuminate\Support\Facades\Log;  // Missing import!
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Mail\CredentialsMail;
//use App\Models\User;


class StudentController extends Controller
{
   
public function studentmanage()
{
    return view('admin.student.Manage');
}
public function addstudent()
{
    return view('admin.student.Add');
}

   
}