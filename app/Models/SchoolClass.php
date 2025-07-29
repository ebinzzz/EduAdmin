<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchoolClass extends Model
{
    use HasFactory;

    protected $table = 'classes';

    protected $fillable = [
        'name',
        'section',
        'display_name',
        'grade_type',
        'grade_level',
        'student_capacity',
        'current_student_count',
        'class_teacher_id',
        'room_number',
        'building',
        'floor_number',
        'academic_year',
        'description',
        'status',
        'amenities',
    ];

    protected $casts = [
        'amenities' => 'array',
    ];

    // Relationships

    public function classTeacher()
    {
        return $this->belongsTo(User::class, 'class_teacher_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    // Accessors

    public function getFullNameAttribute()
    {
        return "{$this->name}-{$this->section}";
    }

    // Scopes (optional, for filtering)

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeForYear($query, $year)
    {
        return $query->where('academic_year', $year);
    }
}
