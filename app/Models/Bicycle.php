<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bicycle extends Model
{
    use HasFactory;

    protected $fillable = [
        'serial_number',
        'bicycle_number',
        'customer_id',
        'brand',
        'model',
        'color',
        'notes',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function serviceHistories()
    {
        return $this->hasMany(ServiceHistory::class);
    }

    public function latestService()
    {
        return $this->hasOne(ServiceHistory::class)->latestOfMany('service_date');
    }
}
