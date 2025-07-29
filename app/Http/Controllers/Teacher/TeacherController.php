<?php

namespace App\Http\Controllers\Teacher;
use App\Models\Teacher;
use App\Mail\TeacherProfileUpdated; // Make sure this Mailable exists
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash; // Missing import!
use Illuminate\Support\Facades\Log;  // Missing import!
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Mail\CredentialsMail;
use App\Models\User;


class TeacherController extends Controller
{
   
public function teachermanage()
{
    $teachers = Teacher::all();
    
    // Get various counts
    $totalTeachers = Teacher::count();
    $activeTeachers = Teacher::where('status', 'Active')->count();
    $inactiveTeachers = Teacher::where('status', 'Inactive')->count();
    $onLeaveTeachers = Teacher::where('status', 'On Leave')->count();
    
    return view('teacher.Manage', compact(
        'teachers', 
        'totalTeachers', 
        'activeTeachers', 
        'inactiveTeachers', 
        'onLeaveTeachers'
    ));
}

    public function addteacher()
    {
        return view('teacher.Add');
    }

    public function store(Request $request)
{
    // ✅ Validate input
    $validated = $request->validate([
        'firstName'       => 'required|string|max:50',
        'lastName'        => 'required|string|max:50',
        'email'           => 'required|email|unique:teachers,email|unique:users,email',
        'phone'           => 'required|string|max:15',
        'employeeId'      => 'required|string|unique:teachers,employee_id',
        'department'      => 'required|string',
        'qualification'   => 'required|string',
        'experience'      => 'nullable|integer|min:0',
        'joinDate'        => 'required|date',
        'salary'          => 'required|numeric|min:0',
        'address'         => 'required|string',
        'sendCredentials' => 'nullable|boolean',
    ]);

    // ✅ Generate random password
    $randomPassword = $this->generatePassword();
    $hashedPassword = Hash::make($randomPassword);

    try {
        // ✅ Create user record first (for authentication)
        $user = User::create([
            'name'       => $validated['firstName'] . ' ' . $validated['lastName'],
            'email'      => $validated['email'],
            'password'   => $hashedPassword,
            'role'       => 'teacher',
        ]);

        // ✅ Create teacher record (for detailed info)
        $teacher = Teacher::create([
            'user_id'        => $user->id, // Link to user table
            'first_name'     => $validated['firstName'],
            'last_name'      => $validated['lastName'],
            'email'          => $validated['email'],
            'phone'          => $validated['phone'],
            'employee_id'    => $validated['employeeId'],
            'password'       => $hashedPassword,
            'department'     => $validated['department'],
            'qualification'  => $validated['qualification'],
            'experience'     => $validated['experience'] ?? 0,
            'join_date'      => $validated['joinDate'],
            'salary'         => $validated['salary'],
            'address'        => $validated['address'],
        ]);

        // ✅ Send credentials email if checkbox is checked
        if ($request->has('sendCredentials') && $request->sendCredentials) {
            $this->sendCredentialsEmail($teacher, $randomPassword, 'teacher');
        }

        return redirect()->route('addteacher')->with('success', 'Teacher added successfully! Welcome ' . $validated['firstName'] . ' ' . $validated['lastName'] . ' to our team.');

    } catch (\Exception $e) {
        return redirect()->back()->withInput()->with('error', 'Failed to add teacher. Please try again.');
    }
}

/**
 * Generate a secure random password
 */
private function generatePassword($length = 12)
{
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $numbers = '0123456789';
    $symbols = '!@#$%^&*';
    
    $password = '';
    $password .= $uppercase[random_int(0, strlen($uppercase) - 1)];
    $password .= $lowercase[random_int(0, strlen($lowercase) - 1)];
    $password .= $numbers[random_int(0, strlen($numbers) - 1)];
    $password .= $symbols[random_int(0, strlen($symbols) - 1)];
    
    $allChars = $uppercase . $lowercase . $numbers . $symbols;
    for ($i = 4; $i < $length; $i++) {
        $password .= $allChars[random_int(0, strlen($allChars) - 1)];
    }
    
    return str_shuffle($password);
}

/**
 * Send credentials email to teacher or student
 */
private function sendCredentialsEmail($user, $password, $userType = 'teacher')
{
    try {
        Mail::to($user->email)->send(new CredentialsMail($user, $password, $userType));
        
        // Log the email sending
        \Log::info("Credentials email sent to {$userType}: {$user->email}");
        
    } catch (\Exception $e) {
        \Log::error("Failed to send credentials email to {$userType}: {$user->email}. Error: " . $e->getMessage());
        
        // You might want to show a warning to the user
        session()->flash('warning', 'User created successfully, but failed to send credentials email.');
    }
}
    
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified teacher in storage.
     */
    /**
 * Update the specified teacher in storage.
 */
public function update(Request $request, Teacher $teacher)
{
    // Add debug logging
    Log::info('Teacher update started', [
        'teacher_id' => $teacher->id,
        'request_data' => $request->except(['password', '_token'])
    ]);

    // Validate the request
    $validatedData = $request->validate([
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'email' => [
            'required',
            'email',
            'max:255',
            Rule::unique('teachers', 'email')->ignore($teacher->id),
            Rule::unique('users', 'email')->ignore($teacher->user_id ?? null) // Also check users table
        ],
        'phone' => 'required|string|max:20',
        'address' => 'required|string|max:500',
        'department' => 'required|string|in:Mathematics,Science,English,History,Computer Science,Physical Education,Art,Music,Languages,Social Studies',
        'joinDate' => 'required|date',
        'salary' => 'required|numeric|min:0',
        'experience' => 'nullable|integer|min:0',
        'status' => 'required|string|in:Active,Inactive,On Leave,Suspended',
        'qualification' => 'nullable|string|max:1000',
        'resetPassword' => 'boolean',
        'accountActive' => 'boolean',
        'sendNotification' => 'boolean'
    ]);

    Log::info('Validation passed', ['teacher_id' => $teacher->id]);

    try {
        // Store original data for comparison
        $originalData = $teacher->toArray();
        
        Log::info('About to update teacher', [
            'teacher_id' => $teacher->id,
            'original_data' => $originalData
        ]);
        
        // Update teacher data
        $updateData = [
            'first_name' => $validatedData['firstName'],
            'last_name' => $validatedData['lastName'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'department' => $validatedData['department'],
            'join_date' => $validatedData['joinDate'],
            'salary' => $validatedData['salary'],
            'experience' => $validatedData['experience'] ?? 0,
            'status' => $validatedData['status'],
            'qualification' => $validatedData['qualification'],
            'is_active' => $request->has('accountActive'),
            'updated_at' => now()
        ];

        Log::info('Update data prepared', ['update_data' => $updateData]);

        $teacher->update($updateData);

        // ✅ UPDATE USER RECORD TOO
        $user = User::where('email', $originalData['email'])->first(); // Find user by old email
        if (!$user && isset($teacher->user_id)) {
            $user = User::find($teacher->user_id); // Try finding by user_id if exists
        }
        
        if ($user) {
            $user->update([
                'name' => $validatedData['firstName'] . ' ' . $validatedData['lastName'],
                'email' => $validatedData['email'],
            ]);
            Log::info('User record updated', ['user_id' => $user->id]);
        } else {
            // Create user record if doesn't exist
            $user = User::create([
                'name' => $validatedData['firstName'] . ' ' . $validatedData['lastName'],
                'email' => $validatedData['email'],
                'password' => $teacher->password, // Use existing password
                'role' => 'teacher',
            ]);
            
            // Update teacher with user_id
            $teacher->update(['user_id' => $user->id]);
            Log::info('User record created', ['user_id' => $user->id]);
        }

        Log::info('Teacher updated successfully', ['teacher_id' => $teacher->id]);

        // Handle password reset if requested
        $newPassword = null;
        if ($request->has('resetPassword') && $request->resetPassword) {
            $newPassword = Str::random(12);
            $hashedPassword = Hash::make($newPassword);
            
            // Update both teacher and user passwords
            $teacher->update(['password' => $hashedPassword]);
            $user->update(['password' => $hashedPassword]);
        }

        // Send notification email if requested (with better error handling)
        if ($request->has('sendNotification') && $request->sendNotification) {
            try {
                $this->sendUpdateNotification($teacher, $originalData, $newPassword);
                Log::info('Email notification sent successfully', ['teacher_id' => $teacher->id]);
                
                // Add email success message
                session()->flash('email_sent', true);
                
            } catch (\Exception $emailException) {
                Log::error('Email sending failed: ' . $emailException->getMessage(), [
                    'teacher_id' => $teacher->id,
                    'teacher_email' => $teacher->email
                ]);
                
                // Add email failure warning (don't fail the entire update)
                session()->flash('email_failed', true);
            }
        }

        // Return success response with detailed messages
        $successMessage = 'Teacher profile updated successfully!';
        if ($newPassword) {
            $successMessage .= ' Password has been reset.';
        }
        if ($request->has('sendNotification') && $request->sendNotification) {
            if (session('email_sent')) {
                $successMessage .= ' Email notification sent.';
            } elseif (session('email_failed')) {
                $successMessage .= ' (Email notification failed to send)';
            }
        }

        return redirect()
            ->back()
            ->with('success', $successMessage)
            ->with('teacher_updated', true);

    } catch (\Exception $e) {
        // Log the error with more details
        Log::error('Teacher update failed: ' . $e->getMessage(), [
            'teacher_id' => $teacher->id,
            'request_data' => $request->except(['password', '_token']), // Exclude sensitive data
            'error_file' => $e->getFile(),
            'error_line' => $e->getLine(),
            'error_trace' => $e->getTraceAsString()
        ]);

        return redirect()
            ->back()
            ->withInput()
            ->with('error', 'Failed to update teacher profile: ' . $e->getMessage());
    }
}   /**
     * Send update notification email to teacher
     */
    private function sendUpdateNotification(Teacher $teacher, array $originalData, $newPassword = null)
    {
        try {
            // Debug logging
            Log::info('Attempting to send email notification', [
                'teacher_id' => $teacher->id,
                'teacher_email' => $teacher->email,
                'has_new_password' => !is_null($newPassword)
            ]);

            // Check if email is valid
            if (!filter_var($teacher->email, FILTER_VALIDATE_EMAIL)) {
                throw new \Exception('Invalid email address: ' . $teacher->email);
            }

            // Get changes
            $changes = $this->getChanges($teacher, $originalData);

            // Prepare email data with all required variables for the template
            $emailData = [
                'teacher' => $teacher,
                'originalData' => $originalData,
                'newPassword' => $newPassword,
                'changes' => $changes,
                'hasNewPassword' => !is_null($newPassword),
                'hasChanges' => count($changes) > 0
            ];

            // Test if the Mailable class exists
            if (!class_exists('App\Mail\TeacherProfileUpdated')) {
                throw new \Exception('TeacherProfileUpdated Mailable class not found');
            }

            // Send email with better error handling
            Mail::to($teacher->email)->send(new TeacherProfileUpdated($emailData));
            
            Log::info('Teacher update notification sent successfully', [
                'teacher_id' => $teacher->id,
                'email' => $teacher->email,
                'has_new_password' => !is_null($newPassword),
                'changes_count' => count($changes)
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to send teacher update notification: ' . $e->getMessage(), [
                'teacher_id' => $teacher->id,
                'teacher_email' => $teacher->email ?? 'N/A',
                'error_trace' => $e->getTraceAsString()
            ]);
            throw $e; // Re-throw to handle in calling method
        }
    }

    /**
     * Get changes made to teacher profile
     */
    private function getChanges(Teacher $teacher, array $originalData)
    {
        $changes = [];
        $currentData = $teacher->fresh()->toArray(); // Get fresh data from database
        
        $fieldsToCheck = [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'address' => 'Address',
            'department' => 'Department',
            'salary' => 'Salary',
            'status' => 'Status',
            'experience' => 'Experience',
            'qualification' => 'Qualification',
            'is_active' => 'Account Status'
        ];

        // Debug logging
        \Log::info('Checking for changes', [
            'teacher_id' => $teacher->id,
            'original_count' => count($originalData),
            'current_count' => count($currentData)
        ]);

        foreach ($fieldsToCheck as $field => $label) {
            $oldValue = $originalData[$field] ?? null;
            $newValue = $currentData[$field] ?? null;
            
            // Convert to string for comparison to handle type differences
            $oldValueStr = (string)$oldValue;
            $newValueStr = (string)$newValue;
            
            if ($oldValueStr !== $newValueStr) {
                $changes[] = [
                    'field' => $label,
                    'old' => $oldValue ?: 'Not set',
                    'new' => $newValue ?: 'Not set'
                ];
                
                \Log::info('Change detected', [
                    'field' => $label,
                    'old' => $oldValue,
                    'new' => $newValue
                ]);
            }
        }

        \Log::info('Total changes found: ' . count($changes));
        return $changes;
    }

    /**
     * Delete the specified teacher
     */
    public function destroy($id)
{
    try {
        // Find the teacher by ID
        $teacher = Teacher::findOrFail($id);
        $teacherName = $teacher->first_name . ' ' . $teacher->last_name;
        
        Log::info('Starting teacher deletion', [
            'teacher_id' => $teacher->id,
            'teacher_name' => $teacherName,
            'teacher_email' => $teacher->email,
            'user_id' => $teacher->user_id ?? 'null'
        ]);
        
        // First, find and delete the user record
        $user = null;
        if ($teacher->user_id) {
            // If teacher has user_id, find by that
            $user = User::find($teacher->user_id);
            Log::info('Found user by user_id', ['user_id' => $teacher->user_id, 'found' => $user ? 'yes' : 'no']);
        } else {
            // If no user_id, find by email
            $user = User::where('email', $teacher->email)->where('role', 'teacher')->first();
            Log::info('Found user by email', ['email' => $teacher->email, 'found' => $user ? 'yes' : 'no']);
        }
        
        if ($user) {
            $user->delete();
            Log::info('User record deleted', ['user_id' => $user->id, 'email' => $user->email]);
        } else {
            Log::warning('No user record found to delete');
        }
        
        // Then delete the teacher record
        $teacher->delete();
        Log::info('Teacher record deleted', ['teacher_id' => $teacher->id]);
        
        return redirect()
            ->route('teachermanage')
            ->with('success', "Teacher {$teacherName} has been deleted successfully.")
            ->with('info', 'All associated data has been removed from the system.');
            
    } catch (\Exception $e) {
        Log::error('Teacher deletion failed: ' . $e->getMessage(), [
            'teacher_id' => $id ?? 'unknown',
            'error_message' => $e->getMessage(),
            'error_file' => $e->getFile(),
            'error_line' => $e->getLine(),
        ]);

        return redirect()
            ->back()
            ->with('error', 'Failed to delete teacher: ' . $e->getMessage());
    }
}
    /**
     * Additional helper methods for AJAX requests
     */
    
    /**
     * Check if email is unique (for AJAX validation)
     */
    public function checkEmailUnique(Request $request, $teacherId = null)
    {
        $email = $request->input('email');
        $query = Teacher::where('email', $email);
        
        if ($teacherId) {
            $query->where('id', '!=', $teacherId);
        }
        
        $exists = $query->exists();
        
        return response()->json([
            'available' => !$exists,
            'message' => $exists ? 'Email already exists' : 'Email is available'
        ]);
    }

    /**
     * Bulk update status
     */
    public function bulkUpdateStatus(Request $request)
    {
        $request->validate([
            'teacher_ids' => 'required|array',
            'teacher_ids.*' => 'exists:teachers,id',
            'status' => 'required|string|in:Active,Inactive,On Leave,Suspended'
        ]);

        try {
            Teacher::whereIn('id', $request->teacher_ids)
                   ->update(['status' => $request->status]);

            return response()->json([
                'success' => true,
                'message' => count($request->teacher_ids) . ' teachers updated successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update teachers'
            ], 500);
        }
    }

    /**
     * Test email sending functionality
     */
    public function testEmail(Request $request)
    {
        try {
            $teacher = Teacher::find($request->teacher_id);
            if (!$teacher) {
                return response()->json(['error' => 'Teacher not found'], 404);
            }

            // Test basic email sending
            Mail::raw('This is a test email from your Laravel application.', function ($message) use ($teacher) {
                $message->to($teacher->email)
                        ->subject('Test Email - Teacher Management System');
            });

            return response()->json(['success' => 'Test email sent successfully']);

        } catch (\Exception $e) {
            Log::error('Test email failed: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send test email: ' . $e->getMessage()], 500);
        }
    }
}