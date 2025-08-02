<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassAmenity extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'item_type',
        'item_name',
        'total_quantity',
        'working_quantity',
        'damaged_quantity',
        'repair_quantity',
        'brand',
        'purchase_date',
        'purchase_cost',
        'overall_condition',
        'vendor',
        'specifications'
    ];

    protected $casts = [
        'total_quantity' => 'integer',
        'working_quantity' => 'integer',
        'damaged_quantity' => 'integer',
        'repair_quantity' => 'integer',
        'purchase_date' => 'date',
        'purchase_cost' => 'decimal:2',
    ];

    /**
     * Get the class this amenity belongs to
     */
    public function class(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    /**
     * Get maintenance records for this amenity
     */
    public function maintenanceRecords(): HasMany
    {
        return $this->hasMany(MaintenanceRecord::class, 'amenity_id');
    }

    /**
     * Scope for specific item type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('item_type', $type);
    }

    /**
     * Scope for items needing maintenance
     */
    public function scopeNeedsMaintenance($query)
    {
        return $query->where(function($q) {
            $q->where('damaged_quantity', '>', 0)
              ->orWhere('repair_quantity', '>', 0)
              ->orWhere('overall_condition', 'poor')
              ->orWhere('overall_condition', 'damaged');
        });
    }

    /**
     * Get the percentage of working items
     */
    public function getWorkingPercentageAttribute(): float
    {
        if ($this->total_quantity == 0) {
            return 0;
        }
        
        return round(($this->working_quantity / $this->total_quantity) * 100, 2);
    }

    /**
     * Get the percentage of damaged items
     */
    public function getDamagedPercentageAttribute(): float
    {
        if ($this->total_quantity == 0) {
            return 0;
        }
        
        return round(($this->damaged_quantity / $this->total_quantity) * 100, 2);
    }

    /**
     * Check if item needs maintenance
     */
    public function needsMaintenance(): bool
    {
        return $this->damaged_quantity > 0 || 
               $this->repair_quantity > 0 || 
               in_array($this->overall_condition, ['poor', 'damaged']);
    }

    /**
     * Get condition color for UI
     */
    public function getConditionColorAttribute(): string
    {
        return match($this->overall_condition) {
            'excellent' => 'green',
            'good' => 'blue',
            'fair' => 'yellow',
            'poor' => 'orange',
            'damaged' => 'red',
            default => 'gray'
        };
    }
}