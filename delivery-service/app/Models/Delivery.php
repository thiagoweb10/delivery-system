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
        'delivery_status_id',
        'order_id',
        'courier_id',
        'customer_id',
        'type',
        'pickup_time',
        'delivery_time',
        'pickup_address',
        'delivery_address',
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

    /**
     * Historico de entrega por tipo de perfil.
     */
    public static function queryByRole(int $role)
    {
        return match ($role) {
            2 => self::CourierBy(),
            3 => self::CustomerBy(),
            default => self::query(),
        };
    }

    public function status()
    {
        return $this->belongsTo(DeliveryStatus::class, 'delivery_status_id');
    }

    public function scopeCourierIsNull($query)
    {
        return $query->whereNull('courier_id');
    }

    public function scopeDeliveredAtIsNull($query)
    {
        return $query->whereNull('delivered_at');
    }

    public function scopeCourierBy($query)
    {
        return $query->where('courier_id', authUserId());
    }

    public function scopeCustomerBy($query)
    {
        return $query->where('customer_id', authUserId());
    }
}
