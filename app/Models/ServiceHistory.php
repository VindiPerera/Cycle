<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'bicycle_id',
        'service_date',
        'service_type',
        'description',
        'parts_replaced',
        'cost',
        'mechanic_name',
        'status',
        'remarks',
    ];

    protected $casts = [
        'service_date' => 'date',
        'cost' => 'decimal:2',
    ];

    public function bicycle()
    {
        return $this->belongsTo(Bicycle::class);
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'pending'     => 'badge-pending',
            'in_progress' => 'badge-progress',
            'completed'   => 'badge-done',
            default       => '',
        };
    }
}
