<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DriverOrder extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_number',
        'user_id',
        'customer_name',
        'customer_phone',
        'customer_email',
        'driver_service_id',
        'service_type',
        'pickup_datetime',
        'pickup_location',
        'destination',
        'hours',
        'total_amount',
        'special_requirements',
        'status',
        'admin_notes'
    ];

    protected $casts = [
        'pickup_datetime' => 'datetime',
        'total_amount' => 'decimal:0'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(DriverService::class, 'driver_service_id');
    }
}
