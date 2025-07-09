<?php

return [

    // 🟢 Define qual conexão usar
    'use' => 'default',

    // 🟢 Conexões disponíveis
    'connections' => [
        'default' => [
            'host'     => env('RABBITMQ_HOST', 'rabbitmq'),
            'port'     => env('RABBITMQ_PORT', 5672),
            'user'     => env('RABBITMQ_USER', 'guest'),
            'password' => env('RABBITMQ_PASSWORD', 'guest'),
            'vhost'    => '/',
        ],
    ],

    // 🟢 Exchange padrão
    'exchange' => [
        'default' => env('AMQP_EXCHANGE', 'user-service'),
    ],

    // 🟢 Fila padrão
    'queue' => [
        'default' => env('AMQP_QUEUE', 'default'),
    ],

    // 🟢 Evita o erro 'Undefined array key "properties"'
    'properties' => [],
];