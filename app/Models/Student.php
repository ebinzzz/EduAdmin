<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_id',           // Custom ID used internally (admission number)
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'class_id',
        'roll_number',
        'admission_number',     // Unique admission number (mapped from form field)
        'admission_date',
        'academic_year',
        'status',
        'phone',
        'email',
        'address',
        'blood_group',
        'guardian_name',
        'guardian_phone',
        'guardian_email',
        'guardian_relation',
        'guardian_occupation',
        'photo'
    ];

    /**
     * Get the user account associated with this student.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the class assigned to the student.
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    /**
     * Get the full name of the student.
     */
    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name}");
    }

    /**
     * Get the profile photo URL.
     */
public function getPhotoUrlAttribute(): string
{
    if ($this->photo) {
        // Temporarily hardcode to test
        return 'http://localhost:8000/storage/' . $this->photo;
    }
    return asset('images/default-avatar.png');
}
    public function schoolClass()
{
    return $this->belongsTo(SchoolClass::class, 'class_id');
}

}
