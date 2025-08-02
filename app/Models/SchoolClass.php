<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SchoolClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'section',
        'class_teacher_id',
        'student_capacity',
        'current_student_count',
        'room_number',
        'building',
        'floor_number',
        'academic_year',
        'description',
        'status'
    ];

    protected $casts = [
        'student_capacity' => 'integer',
        'current_student_count' => 'integer',
        'floor_number' => 'integer',
    ];

    /**
     * Get the class teacher
     */
    public function classTeacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'class_teacher_id');
    }

    /**
     * Get students in this class
     */
    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    /**
     * Get class amenities
     */
    public function amenities(): HasMany
    {
        return $this->hasMany(ClassAmenity::class, 'class_id');
    }

    /**
     * Get maintenance records through amenities
     */
    public function maintenanceRecords()
    {
        return $this->hasManyThrough(MaintenanceRecord::class, ClassAmenity::class, 'class_id', 'amenity_id');
    }

    /**
     * Scope for active classes
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope for specific academic year
     */
    public function scopeForAcademicYear($query, $year)
    {
        return $query->where('academic_year', $year);
    }

    /**
     * Get display name attribute
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->name . ' - ' . $this->section;
    }

    /**
     * Get grade type attribute
     */
    public function getGradeTypeAttribute(): string
    {
        $className = strtoupper($this->name);
        
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
     * Check if class is at capacity
     */
    public function isAtCapacity(): bool
    {
        return $this->current_student_count >= $this->student_capacity;
    }

    /**
     * Get available slots
     */
    public function getAvailableSlotsAttribute(): int
    {
        return max(0, $this->student_capacity - $this->current_student_count);
    }
    public function teacher()
{
    return $this->belongsTo(Teacher::class, 'class_teacher_id');
}
}