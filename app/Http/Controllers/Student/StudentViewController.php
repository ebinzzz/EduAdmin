<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Http\Controllers\Student\Section;
use Exception;

class StudentViewController extends Controller
{
    /**
     * Display students overview with class filters
     */
    public function index(Request $request): View
{
    // Get unique academic years
    $academicYears = SchoolClass::select('academic_year')
        ->distinct()
        ->orderBy('academic_year', 'desc')
        ->pluck('academic_year');

    // Get grade types
    $gradeTypes = [
        'pre_primary' => 'Pre Primary',
        'primary' => 'Primary',
        'secondary' => 'Secondary',
        'higher_secondary' => 'Higher Secondary'
    ];

    // Start with base query
    $query = SchoolClass::where('status', 'active');

    // Apply academic year filter first
    if ($request->filled('academic_year') && 
        !in_array($request->academic_year, ['all', null, ''])) {
        $query->where('academic_year', $request->academic_year);
    } else if (!$request->filled('academic_year') || $request->academic_year === null) {
        // Default to current academic year only when no filter is applied or null
        $query->where('academic_year', '2024-2025');
    }

    // Apply grade type filter - only if a specific grade type is selected
    if ($request->filled('grade_type') && 
        !in_array($request->grade_type, ['all', null, ''])) {
        $gradeTypeClasses = $this->getClassesByGradeType($request->grade_type);
        $query->whereIn('name', $gradeTypeClasses);
    }

    // Now group and select
    $classes = $query->select(
            'name',
            DB::raw('MAX(academic_year) as academic_year'),
            DB::raw('SUM(current_student_count) as total_students'),
            DB::raw('COUNT(*) as sections_count')
        )
        ->groupBy('name')
        ->orderBy('name')
        ->get()
        ->map(function ($class) {
            $class->grade_type = $this->determineGradeType($class->name);
            return $class;
        });

    return view('admin.student.index', compact(
        'classes',
        'academicYears',
        'gradeTypes'
    ));
}    
    /**
     * Show sections for a specific class
     */
public function showSections($className): View|RedirectResponse 
{     
    $sections = SchoolClass::where('name', $className)
        ->with('teacher:id,first_name,last_name') // Eager load teacher relationship
        ->select('id', 'name', 'section', 'academic_year', 'current_student_count','status','student_capacity', 'class_teacher_id') // Include current_student_count and student_capacity
        ->get();
     
    if ($sections->isEmpty()) {         
        return redirect()->route('index')->with('error', 'No sections found for this class.');     
    }      

    // Add concatenated teacher name to each section
    $sections = $sections->map(function ($section) {
        $section->teacher_name = $section->teacher 
            ? $section->teacher->first_name . ' ' . $section->teacher->last_name 
            : 'Not Assigned';
        $section->student_count = $section->current_student_count ?? 0; // Make it easily accessible
        $section->capacity = $section->student_capacity ?? 0; // Make capacity easily accessible
        return $section;
    });

    return view('admin.student.sections', [         
        'className' => $className,         
        'sections' => $sections,         
        'academicYear' => $sections->first()->academic_year,     
    ]); 
}
    /**
     * Show students in a specific class section
     */
    public function showStudents($classId, Request $request): View
    {
        try {
            $class = SchoolClass::with(['classTeacher:id,first_name,last_name'])
                ->findOrFail($classId);

            // Get students in this class
              $students = Student::where('class_id', $classId)
                ->where('status', 'active')
                ->orderBy('first_name')
                ->orderBy('last_name')
                ->get()
                ->map(function ($student) {
                    $student->photo = $student->photo_url; // This uses your updated accessor
                    $student->full_name = trim($student->first_name . ' ' . $student->last_name);
                    
                    return $student;
                });
            $teacherName = $class->classTeacher 
                ? $class->classTeacher->first_name . ' ' . $class->classTeacher->last_name 
                : 'Not Assigned';

            return view('admin.student.students', compact(
                'students',
                'class',
                'teacherName'
            ));

        } catch (Exception $e) {
            return redirect()->route('index')
                ->with('error', 'Class not found or error loading students.');
        }
    }

    /**
     * Get classes by grade type
     */
    private function getClassesByGradeType($gradeType): array
    {
        switch ($gradeType) {
            case 'pre_primary':
                return ['LKG', 'UKG'];
            case 'primary':
                return ['1', '2', '3', '4', '5'];
            case 'secondary':
                return ['6', '7', '8', '9', '10'];
            case 'higher_secondary':
                return ['11', '12'];
            default:
                return [];
        }
    }

    /**
     * Determine grade type based on class name
     */
    private function determineGradeType($className): string
    {
        $className = strtoupper($className);
        
        if (in_array($className, ['LKG', 'UKG'])) {
            return 'pre_primary';
        } elseif (in_array($className, ['1', '2', '3', '4', '5'])) {
            return 'primary';
        } elseif (in_array($className, ['6', '7', '8', '9', '10'])) {
            return 'secondary';
        } elseif (in_array($className, ['11', '12'])) {
            return 'higher_secondary';
        }
        
        return 'primary'; // default
    }

    /**
     * Get students data as JSON (for AJAX requests)
     */
    public function getStudentsJson($classId): JsonResponse
    {
        try {
            $students = Student::where('class_id', $classId)
                ->where('status', 'active')
                ->orderBy('first_name')
                ->orderBy('last_name')
                ->get()
                ->map(function ($student) {
                    $student->profile_picture_url = $student->profile_picture 
                        ? asset('storage/' . $student->profile_picture)
                        : asset('images/default-avatar.png');
                    
                    $student->full_name = trim($student->first_name . ' ' . $student->last_name);
                    
                    return $student;
                });

            return response()->json([
                'success' => true,
                'students' => $students
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch students',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}