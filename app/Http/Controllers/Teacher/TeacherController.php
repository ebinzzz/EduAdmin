<?php

namespace App\Http\Controllers\Teacher;
use App\Models\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function teachermanage()
    {
        $teachers = Teacher::all();
        return view('teacher.Manage', compact('teachers'));
    }

    public function addteacher()
    {
        return view('teacher.Add');
    }

    public function store(Request $request)
{
    // ✅ Validate input
    $validated = $request->validate([
        'firstName'     => 'required|string|max:50',
        'lastName'      => 'required|string|max:50',
        'email'         => 'required|email|unique:teachers,email',
        'phone'         => 'required|string|max:15',
        'employeeId'    => 'required|string|unique:teachers,employee_id',
        'department'    => 'required|string',
        'qualification' => 'required|string',
        'experience'    => 'nullable|integer|min:0',
        'joinDate'      => 'required|date',
        'salary'        => 'required|numeric|min:0',
        'address'       => 'required|string',
    ]);

    // ✅ Create new teacher using mass assignment
    Teacher::create([
        'first_name'     => $validated['firstName'],
        'last_name'      => $validated['lastName'],
        'email'          => $validated['email'],
        'phone'          => $validated['phone'],
        'employee_id'    => $validated['employeeId'],
        'department'     => $validated['department'],
        'qualification'  => $validated['qualification'],
        'experience'     => $validated['experience'] ?? 0,
        'join_date'      => $validated['joinDate'],
        'salary'         => $validated['salary'],
        'address'        => $validated['address'],
    ]);

return redirect()->route('addteacher')->with('success', 'Teacher added successfully.');
}
        public function edit($id)
{
    $teacher = Teacher::findOrFail($id);
    return view('teacher.edit', compact('teacher'));
}


}
