<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryStatus extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'color',
    ];

    public function deliveries()
    {
        return $this->belongsTo(Delivery::class);
    }
}
