<?php

namespace App\DTOs;

class AcceptDeliveryDTO
{
    public function __construct(
        public int $deliveryId,
        public int $courierId,
    ) {
    }
}
