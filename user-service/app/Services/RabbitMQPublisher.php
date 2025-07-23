<?php

namespace App\Services;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQPublisher
{
    private string $host;
    private int $port;
    private string $user;
    private string $password;
    private string $exchange;

    public function __construct()
    {
        $this->host = env('RABBITMQ_HOST', 'rabbitmq');
        $this->port = env('RABBITMQ_PORT', 5672);
        $this->user = env('RABBITMQ_USER', 'guest');
        $this->password = env('RABBITMQ_PASSWORD', 'guest');
        $this->exchange = env('RABBITMQ_EXCHANGE', 'user.process');
    }

    public function publish(string $routingKey, array $data): void
    {
        \Log::info("Tentando conectar no RabbitMQ {$this->host}:{$this->port}");
        $connection = new AMQPStreamConnection(
            $this->host,
            $this->port,
            $this->user,
            $this->password
        );

        $channel = $connection->channel();

        // Garante que a exchange exista
        $channel->exchange_declare(
            $this->exchange,
            'direct',
            false,
            true,
            false
        );

        $message = new AMQPMessage(
            json_encode($data),
            [
                'content_type' => 'application/json',
                'delivery_mode' => 2, // Persistente
            ]
        );

        $channel->basic_publish($message, $this->exchange, $routingKey);

        $channel->close();
        $connection->close();
    }
}
