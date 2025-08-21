<?php

namespace App\Services;

use App\Models\Delivery;

class CustomerService
{
    public function listDeliveries()
    {
        return Delivery::CustomerBy()->paginate(10);
    }
}
