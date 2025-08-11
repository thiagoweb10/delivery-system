<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    /** @use HasFactory<\Database\Factories\DeliveryFactory> */
    use HasFactory;

    protected $table = 'deliveries';

    protected $fillable = [
        'tracking_code',
        'status',
        'type',
        'customer_name',
        'customer_email',
        'customer_phone',
        'pickup_address',
        'dropoff_address',
        'expected_date',
        'delivered_at',
    ];

    /**
     * Tipos de casting para atributos.
     */
    protected $casts = [
        'expected_date' => 'datetime',
        'delivered_at' => 'datetime',
    ];
}
