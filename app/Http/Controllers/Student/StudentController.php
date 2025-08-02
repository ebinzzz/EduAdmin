<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Mail\CredentialsMail;
use App\Models\SchoolClass;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;



class StudentController extends Controller
{
        

     public function studentmanage()
{
    // Eager load the class details
    $students = Student::with('schoolClass')->get();

    // Get status counts
    $totalStudents = Student::count();
    $activeStudents = Student::where('status', 'active')->count();
    $inactiveStudents = Student::where('status', 'inactive')->count();
    $onLeaveStudents = Student::where('status', 'on_leave')->count();

    return view('admin.student.Manage', compact(
        'students', 
        'totalStudents', 
        'activeStudents', 
        'inactiveStudents', 
        'onLeaveStudents'
    ));
}

    public function addstudent()
    {
        $classes = SchoolClass::select('id', 'name', 'section')
            ->orderByRaw("CASE 
                WHEN name = 'LKG' THEN 0
                WHEN name = 'UKG' THEN 1
                ELSE CAST(name AS UNSIGNED) + 2
            END")
            ->orderBy('section')
            ->get();

        return view('admin.student.Add', compact('classes'));
    }

    public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|string|in:male,female,other',
            'class_id' => 'required|exists:school_classes,id',
            'roll_number' => 'required|integer|min:1',
            'student_id' => 'required|string|max:50|unique:students,admission_number',
            'admission_date' => 'required|date',
            'academic_year' => 'required|string|max:20',
            'status' => 'required|string|in:active,inactive,suspended',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|max:255|unique:users,email',
            'address' => 'nullable|string|max:1000',
            'blood_group' => 'nullable|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'guardian_name' => 'required|string|max:255',
            'guardian_relationship' => 'required|string|in:father,mother,grandfather,grandmother,uncle,aunt,other',
            'guardian_phone' => 'required|string|max:20',
            'guardian_email' => 'nullable|email|max:255',
            'guardian_occupation' => 'nullable|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'send_credentials' => 'nullable|in:1,on',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $fileName = time() . '_' . $photo->getClientOriginalName();
            $photoPath = $photo->storeAs('photos/students', $fileName, 'public');
        }

        DB::beginTransaction();

        // Fetch the school class and check capacity (optional)
        $schoolClass = SchoolClass::findOrFail($validated['class_id']);
        
        // Optional: Check if class has capacity
        // if ($schoolClass->current_student_count >= $schoolClass->max_capacity) {
        //     throw new \Exception('Class has reached maximum capacity');
        // }

        $user = User::create([
            'name' => trim($validated['first_name'] . ' ' . ($validated['last_name'] ?? '')),
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student',
            'email_verified_at' => now(),
        ]);

        $student = Student::create([
            'user_id' => $user->id,
            'student_id' => $validated['student_id'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'class_id' => $validated['class_id'],
            'roll_number' => $validated['roll_number'],
            'admission_number' => $validated['student_id'],
            'admission_date' => $validated['admission_date'],
            'academic_year' => $validated['academic_year'],
            'status' => $validated['status'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'blood_group' => $validated['blood_group'],
            'guardian_name' => $validated['guardian_name'],
            'guardian_phone' => $validated['guardian_phone'],
            'guardian_email' => $validated['guardian_email'],
            'guardian_relation' => $validated['guardian_relationship'],
            'guardian_occupation' => $validated['guardian_occupation'],
            'photo' => $photoPath,
        ]);

        // Increment the current_student_count for the school class
        $schoolClass->increment('current_student_count');

        if ($request->filled('send_credentials')) {
            try {
                if (class_exists('App\Mail\StudentCredentialsMail')) {
                    Mail::to($validated['email'])->send(new \App\Mail\StudentCredentialsMail([
                        'name' => $user->name,
                        'email' => $validated['email'],
                        'password' => $validated['password'],
                        'student_id' => $validated['student_id']
                    ]));
                }

                if (!empty($validated['guardian_email']) && class_exists('App\Mail\GuardianNotificationMail')) {
                    Mail::to($validated['guardian_email'])->send(new \App\Mail\GuardianNotificationMail([
                        'student_name' => $user->name,
                        'guardian_name' => $validated['guardian_name'],
                        'student_id' => $validated['student_id']
                    ]));
                }
            } catch (\Exception $mailException) {
                Log::warning('Email sending failed: ' . $mailException->getMessage());
            }
        }

        DB::commit();
        return redirect()->route('addstudent')
            ->with('success', 'Student "' . $user->name . '" has been created successfully!' .
                ($request->filled('send_credentials') ? ' Login credentials have been sent via email.' : ''));

    } catch (\Illuminate\Validation\ValidationException $e) {
        DB::rollBack();
        return redirect()->route('addstudent')
            ->withErrors($e->validator)
            ->withInput()
            ->with('error', 'Please check the form for errors and try again.');
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Student creation failed: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString(),
            'request_data' => $request->except(['password', 'password_confirmation'])
        ]);
        return redirect()->route('addstudent')
            ->with('error', 'Failed to create student. Please try again or contact administrator.')
            ->withInput();
    }
}

    public function viewUpdateForm(Student $student)
{
    // Get list of classes to populate dropdowns
    $classes = SchoolClass::all();

    // Prepare student data (you may load relations if needed)
    $student->load('user'); // eager load related user data

    return view('admin.student.update', [
        'student' => $student,
        'classes' => $classes
    ]);
}
    

// Add this import at the top of your controller file

public function update(Request $request, Student $student)
{
    try {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|string|in:male,female,other',
            'class_id' => 'required|exists:school_classes,id',
            'roll_number' => [
                'required',
                'string',
                'max:50',
                Rule::unique('students')->where(function ($query) use ($request) {
                    return $query->where('class_id', $request->class_id);
                })->ignore($student->id)
            ],
            'admission_number' => 'required|string|max:50|unique:students,admission_number,' . $student->id,
            'admission_date' => 'nullable|date|before_or_equal:today',
            'academic_year' => 'nullable|string|max:20',
            'status' => 'required|string|in:active,inactive,suspended,graduated,transferred',
            'phone' => 'nullable|string|max:20',
            'email' => 'required|email|max:255|unique:users,email,' . $student->user_id,
            'address' => 'nullable|string|max:1000',
            'blood_group' => 'nullable|string|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'guardian_name' => 'required|string|max:255',
            'guardian_relation' => 'required|string|in:father,mother,grandfather,grandmother,uncle,aunt,other',
            'guardian_phone' => 'required|string|max:20',
            'guardian_email' => 'nullable|email|max:255',
            'guardian_occupation' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'send_password_notification' => 'nullable|in:1,on',
            'photo' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->filled('remove_photo') && $request->remove_photo == '1' && $value) {
                        $fail('Cannot upload and remove photo at the same time.');
                    }
                }
            ],
            'remove_photo' => 'nullable|in:0,1',
        ]);

        DB::beginTransaction();

        $user = $student->user;

        // Handle photo upload/removal
        $photoPath = $student->photo; // Keep existing photo by default

        // Handle photo removal
        if ($request->filled('remove_photo') && $request->remove_photo == '1') {
            // Delete old photo from storage
            if ($student->photo && Storage::disk('public')->exists($student->photo)) {
                try {
                    Storage::disk('public')->delete($student->photo);
                } catch (\Exception $e) {
                    Log::warning('Failed to delete old photo: ' . $e->getMessage());
                }
            }
            $photoPath = null;
        }

        // Handle new photo upload (only if not removing)
        if ($request->hasFile('photo') && (!$request->filled('remove_photo') || $request->remove_photo != '1')) {
            // Delete old photo before uploading new one
            if ($student->photo && Storage::disk('public')->exists($student->photo)) {
                try {
                    Storage::disk('public')->delete($student->photo);
                } catch (\Exception $e) {
                    Log::warning('Failed to delete old photo: ' . $e->getMessage());
                }
            }
            
            try {
                $photo = $request->file('photo');
                $fileName = time() . '_' . $photo->getClientOriginalName();
                $photoPath = $photo->storeAs('photos/students', $fileName, 'public');
            } catch (\Exception $e) {
                Log::error('Photo upload failed: ' . $e->getMessage());
                throw new \Exception('Failed to upload photo. Please try again.');
            }
        }

        // Update user data
        $user->update([
            'name' => trim($validated['first_name'] . ' ' . ($validated['last_name'] ?? '')),
            'email' => $validated['email'],
            'password' => isset($validated['password']) ? Hash::make($validated['password']) : $user->password,
        ]);

        // Handle class change - update student counts
        $oldClassId = $student->class_id;
        $newClassId = $validated['class_id'];
        
        if ($oldClassId != $newClassId) {
            // Decrement count from old class
            $oldClass = SchoolClass::find($oldClassId);
            if ($oldClass) {
                $oldClass->decrement('current_student_count');
            }
            
            // Increment count for new class
            $newClass = SchoolClass::find($newClassId);
            if ($newClass) {
                $newClass->increment('current_student_count');
            }
        }

        // Update student data - using only fillable fields
        $studentData = [
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
            'class_id' => $validated['class_id'],
            'roll_number' => $validated['roll_number'],
            'admission_number' => $validated['admission_number'],
            'admission_date' => $validated['admission_date'] ?? null,
            'academic_year' => $validated['academic_year'] ?? null,
            'status' => $validated['status'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'blood_group' => $validated['blood_group'],
            'guardian_name' => $validated['guardian_name'],
            'guardian_phone' => $validated['guardian_phone'],
            'guardian_email' => $validated['guardian_email'],
            'guardian_relation' => $validated['guardian_relation'],
            'guardian_occupation' => $validated['guardian_occupation'],
            'photo' => $photoPath,
        ];

        $student->update($studentData);

        // Send notifications if password was updated
        if ($request->filled('send_password_notification') && isset($validated['password'])) {
            try {
                // Send to student
                if (class_exists('App\Mail\StudentCredentialsMail')) {
                    Mail::to($validated['email'])->send(new \App\Mail\StudentCredentialsMail([
                        'name' => $user->name,
                        'email' => $validated['email'],
                        'password' => $validated['password'],
                        'student_id' => $validated['admission_number'],
                        'roll_number' => $validated['roll_number']
                    ]));
                }

                // Send to guardian if email exists
                if (!empty($validated['guardian_email']) && class_exists('App\Mail\GuardianNotificationMail')) {
                    Mail::to($validated['guardian_email'])->send(new \App\Mail\GuardianNotificationMail([
                        'student_name' => $user->name,
                        'guardian_name' => $validated['guardian_name'],
                        'student_id' => $validated['admission_number'],
                        'roll_number' => $validated['roll_number'],
                        'action' => 'password_updated'
                    ]));
                }
            } catch (\Exception $mailException) {
                Log::warning('Email sending failed: ' . $mailException->getMessage());
            }
        }

        DB::commit();
        
        return redirect()->route('students.edit', $student->id)
            ->with('success', 'Student "' . $user->name . '" has been updated successfully!');
            
    } catch (\Illuminate\Validation\ValidationException $e) {
        DB::rollBack();
        return redirect()->route('students.edit', $student->id)
            ->withErrors($e->validator)
            ->withInput()
            ->with('error', 'Please check the form for errors and try again.');
            
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Student update failed: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString(),
            'request_data' => $request->except(['password', 'password_confirmation']),
        ]);
        
        return redirect()->route('students.edit', $student->id)
            ->with('error', 'Failed to update student. Please try again later.')
            ->withInput();
    }
}
public function showBiodata($id): View
    {
        try {
            $student = Student::with([
                'schoolClass:id,name,section,room_number,building,floor_number,academic_year',
                'schoolClass.classTeacher:id,first_name,last_name',
                'user:id,name,email,created_at'
            ])->findOrFail($id);

            // Check if student is active (optional security check)
            if ($student->status === 'suspended') {
                return redirect()->route('students.index')
                    ->with('warning', 'Access to suspended student profile is restricted.');
            }

            return view('admin.student.Bio', compact('student'));

        } catch (Exception $e) {
            return redirect()->route('students.index')
                ->with('error', 'Student not found or error loading profile.');
        }
    }
}