<?php

namespace App\Http\Controllers\Class;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\SchoolClass;
use App\Models\ClassAmenity;
use App\Models\MaintenanceRecord;
use App\Models\Teacher;
use App\Models\Student;
use Exception;

class ClassManagementController extends Controller
{
    /**
     * Display the class management dashboard
     */
    public function index(): View
    {
        $totalClasses = SchoolClass::where('academic_year', '2024-2025')->count();
        $totalStudents = Student::whereHas('schoolClass', function($query) {
            $query->where('academic_year', '2024-2025');
        })->count();
        $teachersAssigned = SchoolClass::where('academic_year', '2024-2025')
            ->whereNotNull('class_teacher_id')
            ->count();
        $maintenanceRequired = MaintenanceRecord::where('status', 'pending')
            ->orWhere('status', 'in_progress')
            ->count();

        $teachers = Teacher::where('status', 'active')
            ->orderBy('name')
            ->get(['id', 'name']);

        return view('admin.class-management.index', compact(
            'totalClasses',
            'totalStudents', 
            'teachersAssigned',
            'maintenanceRequired',
            'teachers'
        ));
    }

    /**
     * Get all classes with related data
     */
    public function getClasses(Request $request): JsonResponse
    {
        try {
            $query = SchoolClass::with(['classTeacher:id,name', 'students'])
                ->withCount('students as current_student_count');

            // Apply filters
            if ($request->filled('grade_type')) {
                $query->where('grade_type', $request->grade_type);
            }

            if ($request->filled('academic_year')) {
                $query->where('academic_year', $request->academic_year);
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('section', 'like', "%{$search}%")
                      ->orWhere('room_number', 'like', "%{$search}%")
                      ->orWhereHas('classTeacher', function($teacherQuery) use ($search) {
                          $teacherQuery->where('name', 'like', "%{$search}%");
                      });
                });
            }

            $classes = $query->orderBy('name')->orderBy('section')->get();

            // Add display_name and grade_type to each class
            $classes->each(function($class) {
                $class->display_name = $class->name . ' - ' . $class->section;
                $class->grade_type = $this->determineGradeType($class->name);
            });

            return response()->json([
                'success' => true,
                'classes' => $classes
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch classes',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a new class
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'section' => 'required|string|max:10',
            'class_teacher_id' => 'nullable|exists:teachers,id',
            'student_capacity' => 'required|integer|min:1|max:100',
            'room_number' => 'nullable|string|max:20',
            'building' => 'nullable|string|max:100',
            'floor_number' => 'nullable|integer|min:0|max:10',
            'academic_year' => 'required|string|max:20',
            'description' => 'nullable|string|max:500'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Check if class already exists
            $existingClass = SchoolClass::where('name', $request->name)
                ->where('section', $request->section)
                ->where('academic_year', $request->academic_year)
                ->first();

            if ($existingClass) {
                return response()->json([
                    'success' => false,
                    'message' => 'Class with this name and section already exists for the academic year'
                ], 409);
            }

            // Check if teacher is already assigned to another class
            if ($request->filled('class_teacher_id')) {
                $teacherAssigned = SchoolClass::where('class_teacher_id', $request->class_teacher_id)
                    ->where('academic_year', $request->academic_year)
                    ->where('status', 'active')
                    ->exists();

                if ($teacherAssigned) {
                    return response()->json([
                        'success' => false,
                        'message' => 'This teacher is already assigned to another class'
                    ], 409);
                }
            }

            $class = SchoolClass::create([
                'name' => $request->name,
                'section' => $request->section,
                'class_teacher_id' => $request->class_teacher_id,
                'student_capacity' => $request->student_capacity,
                'room_number' => $request->room_number,
                'building' => $request->building ?: 'Main Block',
                'floor_number' => $request->floor_number,
                'academic_year' => $request->academic_year,
                'description' => $request->description,
                'status' => 'active'
            ]);

            $class->load('classTeacher:id,name');
            $class->display_name = $class->name . ' - ' . $class->section;
            $class->grade_type = $this->determineGradeType($class->name);

            return response()->json([
                'success' => true,
                'message' => 'Class created successfully',
                'class' => $class
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create class',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update a class
     */
    public function update(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'section' => 'required|string|max:10',
            'class_teacher_id' => 'nullable|exists:teachers,id',
            'student_capacity' => 'required|integer|min:1|max:100',
            'room_number' => 'nullable|string|max:20',
            'building' => 'nullable|string|max:100',
            'floor_number' => 'nullable|integer|min:0|max:10',
            'description' => 'nullable|string|max:500',
            'status' => 'in:active,inactive'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $class = SchoolClass::findOrFail($id);

            // Check if class name/section combination already exists (excluding current class)
            $existingClass = SchoolClass::where('name', $request->name)
                ->where('section', $request->section)
                ->where('academic_year', $class->academic_year)
                ->where('id', '!=', $id)
                ->first();

            if ($existingClass) {
                return response()->json([
                    'success' => false,
                    'message' => 'Class with this name and section already exists'
                ], 409);
            }

            // Check if teacher is already assigned to another class
            if ($request->filled('class_teacher_id') && $request->class_teacher_id != $class->class_teacher_id) {
                $teacherAssigned = SchoolClass::where('class_teacher_id', $request->class_teacher_id)
                    ->where('academic_year', $class->academic_year)
                    ->where('status', 'active')
                    ->where('id', '!=', $id)
                    ->exists();

                if ($teacherAssigned) {
                    return response()->json([
                        'success' => false,
                        'message' => 'This teacher is already assigned to another class'
                    ], 409);
                }
            }

            $class->update($request->only([
                'name', 'section', 'class_teacher_id', 'student_capacity',
                'room_number', 'building', 'floor_number', 'description', 'status'
            ]));

            $class->load('classTeacher:id,name');
            $class->display_name = $class->name . ' - ' . $class->section;
            $class->grade_type = $this->determineGradeType($class->name);

            return response()->json([
                'success' => true,
                'message' => 'Class updated successfully',
                'class' => $class
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update class',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete a class
     */
    public function destroy($id): JsonResponse
    {
        try {
            $class = SchoolClass::findOrFail($id);

            // Check if class has students
            if ($class->students()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete class with enrolled students'
                ], 409);
            }

            // Soft delete or hard delete based on your preference
            $class->delete();

            return response()->json([
                'success' => true,
                'message' => 'Class deleted successfully'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete class',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get amenities for classes
     */
    public function getAmenities(Request $request): JsonResponse
    {
        try {
            $query = ClassAmenity::with(['class:id,name,section']);

            if ($request->filled('class_id')) {
                $query->where('class_id', $request->class_id);
            }

            $amenities = $query->orderBy('item_type')
                ->orderBy('item_name')
                ->get();

            // Add display names and calculated fields
            $amenities->each(function($amenity) {
                $amenity->class->display_name = $amenity->class->name . ' - ' . $amenity->class->section;
            });

            return response()->json([
                'success' => true,
                'amenities' => $amenities
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch amenities',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a new amenity
     */
    public function storeAmenity(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'class_id' => 'required|exists:school_classes,id',
            'item_type' => 'required|in:furniture,equipment,electronics,stationary',
            'item_name' => 'required|string|max:100',
            'total_quantity' => 'required|integer|min:1',
            'working_quantity' => 'nullable|integer|min:0',
            'damaged_quantity' => 'nullable|integer|min:0',
            'repair_quantity' => 'nullable|integer|min:0',
            'brand' => 'nullable|string|max:100',
            'purchase_date' => 'nullable|date',
            'purchase_cost' => 'nullable|numeric|min:0',
            'overall_condition' => 'required|in:excellent,good,fair,poor,damaged',
            'vendor' => 'nullable|string|max:200',
            'specifications' => 'nullable|string|max:1000'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Validate quantities
            $total = $request->total_quantity;
            $working = $request->working_quantity ?: $total;
            $damaged = $request->damaged_quantity ?: 0;
            $repair = $request->repair_quantity ?: 0;

            if (($working + $damaged + $repair) > $total) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sum of working, damaged, and repair quantities cannot exceed total quantity'
                ], 422);
            }

            $amenity = ClassAmenity::create([
                'class_id' => $request->class_id,
                'item_type' => $request->item_type,
                'item_name' => $request->item_name,
                'total_quantity' => $total,
                'working_quantity' => $working,
                'damaged_quantity' => $damaged,
                'repair_quantity' => $repair,
                'brand' => $request->brand,
                'purchase_date' => $request->purchase_date,
                'purchase_cost' => $request->purchase_cost,
                'overall_condition' => $request->overall_condition,
                'vendor' => $request->vendor,
                'specifications' => $request->specifications
            ]);

            $amenity->load('class:id,name,section');
            $amenity->class->display_name = $amenity->class->name . ' - ' . $amenity->class->section;

            return response()->json([
                'success' => true,
                'message' => 'Amenity added successfully',
                'amenity' => $amenity
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to add amenity',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get maintenance records
     */
    public function getMaintenanceRecords(Request $request): JsonResponse
    {
        try {
            $query = MaintenanceRecord::with(['amenity.class:id,name,section']);

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            if ($request->filled('priority')) {
                $query->where('priority', $request->priority);
            }

            $records = $query->orderBy('maintenance_date', 'desc')
                ->orderBy('priority', 'desc')
                ->get();

            // Add display names
            $records->each(function($record) {
                $record->amenity->class->display_name = $record->amenity->class->name . ' - ' . $record->amenity->class->section;
            });

            return response()->json([
                'success' => true,
                'records' => $records
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch maintenance records',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Schedule maintenance
     */
    public function scheduleMaintenance(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'amenity_id' => 'required|exists:class_amenities,id',
            'maintenance_type' => 'required|in:repair,replacement,upgrade,disposal',
            'maintenance_date' => 'required|date|after_or_equal:today',
            'priority' => 'required|in:low,medium,high,urgent',
            'quantity_affected' => 'required|integer|min:1',
            'issue_description' => 'required|string|max:1000',
            'maintenance_cost' => 'nullable|numeric|min:0',
            'maintenance_vendor' => 'nullable|string|max:200'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $amenity = ClassAmenity::findOrFail($request->amenity_id);

            // Validate quantity
            if ($request->quantity_affected > $amenity->total_quantity) {
                return response()->json([
                    'success' => false,
                    'message' => 'Quantity affected cannot exceed total quantity'
                ], 422);
            }

            $maintenance = MaintenanceRecord::create([
                'amenity_id' => $request->amenity_id,
                'maintenance_type' => $request->maintenance_type,
                'maintenance_date' => $request->maintenance_date,
                'priority' => $request->priority,
                'quantity_affected' => $request->quantity_affected,
                'issue_description' => $request->issue_description,
                'maintenance_cost' => $request->maintenance_cost,
                'maintenance_vendor' => $request->maintenance_vendor,
                'status' => 'pending',
                'created_by' => auth()->id()
            ]);

            $maintenance->load('amenity.class:id,name,section');
            $maintenance->amenity->class->display_name = $maintenance->amenity->class->name . ' - ' . $maintenance->amenity->class->section;

            return response()->json([
                'success' => true,
                'message' => 'Maintenance scheduled successfully',
                'maintenance' => $maintenance
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to schedule maintenance',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update maintenance status
     */
    public function updateMaintenanceStatus(Request $request, $id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,in_progress,completed,cancelled'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid status',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $maintenance = MaintenanceRecord::findOrFail($id);
            $maintenance->update([
                'status' => $request->status,
                'updated_by' => auth()->id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully'
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update status',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Export classes data
     */
    public function exportClasses(): JsonResponse
    {
        try {
            $classes = SchoolClass::with(['classTeacher:id,name', 'students'])
                ->withCount('students as current_student_count')
                ->orderBy('name')
                ->orderBy('section')
                ->get();

            $exportData = $classes->map(function($class) {
                return [
                    'Class' => $class->name . ' - ' . $class->section,
                    'Teacher' => $class->classTeacher?->name ?: 'Not Assigned',
                    'Students' => $class->current_student_count . '/' . $class->student_capacity,
                    'Room' => $class->room_number ?: 'Not Assigned',
                    'Building' => $class->building ?: 'Main',
                    'Floor' => $class->floor_number !== null ? $class->floor_number : 'N/A',
                    'Academic Year' => $class->academic_year,
                    'Status' => ucfirst($class->status)
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $exportData
            ]);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to export data',
                'error' => $e->getMessage()
            ], 500);
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
}