<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',           // Add this
        'first_name',
        'last_name',
        'email',
        'phone',
        'employee_id',
        'password',
        'department',
        'qualification',
        'experience',
        'join_date',
        'salary',
        'address',
        'status',
        'is_active',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'join_date' => 'date',
        'salary' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}