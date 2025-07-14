<?php

namespace App\Services\Publishers;

use Bschmitt\Amqp\Facades\Amqp;

class UserRegisteredPublisher
{
    public static function dispatch(array $payload): void
    {
        Amqp::publish('user.registered', json_encode($payload),[
            'exchange' => 'user-service',
            'properties' => [],
        ]);
    }
}