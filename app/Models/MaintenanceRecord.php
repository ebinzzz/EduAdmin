<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'amenity_id',
        'maintenance_type',
        'maintenance_date',
        'priority',
        'quantity_affected',
        'issue_description',
        'maintenance_cost',
        'maintenance_vendor',
        'status',
        'completion_notes',
        'completion_date',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'maintenance_date' => 'date',
        'completion_date' => 'date',
        'quantity_affected' => 'integer',
        'maintenance_cost' => 'decimal:2',
    ];

    /**
     * Get the amenity this maintenance record belongs to
     */
    public function amenity(): BelongsTo
    {
        return $this->belongsTo(ClassAmenity::class, 'amenity_id');
    }

    /**
     * Get the user who created this record
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user who last updated this record
     */
    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Scope for pending maintenance
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for in progress maintenance
     */
    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    /**
     * Scope for completed maintenance
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Scope for urgent priority
     */
    public function scopeUrgent($query)
    {
        return $query->where('priority', 'urgent');
    }

    /**
     * Scope for high priority
     */
    public function scopeHighPriority($query)
    {
        return $query->whereIn('priority', ['urgent', 'high']);
    }

    /**
     * Scope for overdue maintenance
     */
    public function scopeOverdue($query)
    {
        return $query->where('maintenance_date', '<', now())
                    ->whereIn('status', ['pending', 'in_progress']);
    }

    /**
     * Check if maintenance is overdue
     */
    public function isOverdue(): bool
    {
        return $this->maintenance_date < now() && 
               in_array($this->status, ['pending', 'in_progress']);
    }

    /**
     * Get priority color for UI
     */
    public function getPriorityColorAttribute(): string
    {
        return match($this->priority) {
            'urgent' => 'red',
            'high' => 'orange',
            'medium' => 'yellow',
            'low' => 'green',
            default => 'gray'
        };
    }

    /**
     * Get status color for UI
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'yellow',
            'in_progress' => 'blue',
            'completed' => 'green',
            'cancelled' => 'red',
            default => 'gray'
        };
    }

    /**
     * Get days until maintenance
     */
    public function getDaysUntilMaintenanceAttribute(): int
    {
        return now()->diffInDays($this->maintenance_date, false);
    }

    /**
     * Mark as completed
     */
    public function markCompleted($notes = null, $userId = null): bool
    {
        return $this->update([
            'status' => 'completed',
            'completion_date' => now(),
            'completion_notes' => $notes,
            'updated_by' => $userId ?? auth()->id()
        ]);
    }
}