<?php

namespace App\Jobs;

use PhpAmqpLib\Message\AMQPMessage;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class SendToRabbitMQ implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public array $payload,
        public string $queueName
    )
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {

            $connection = new AMQPStreamConnection(
                env('RABBITMQ_HOST', 'localhost'),
                env('RABBITMQ_PORT', 5672),
                env('RABBITMQ_USER', 'guest'),
                env('RABBITMQ_PASS', 'guest')
            );

            $channel = $connection->channel();
            $exchange = 'user.process';
            $routingKey = $this->queueName; // ex: 'user.welcome' ou 'user.reset'

            // 1. Declara a exchange (direct, durável)
            $channel->exchange_declare($exchange, 'direct', false, true, false);

            // 2. Declara a fila (durável)
            $channel->queue_declare($this->queueName, false, true, false, false);

            // 3. Faz o bind da fila com a exchange e a routing key
            $channel->queue_bind($this->queueName, $exchange, $routingKey);

            // 4. Prepara a mensagem
            $msgBody = json_encode($this->payload);
            $msg = new AMQPMessage($msgBody, [
                'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT
            ]);

            // 5. Publica a mensagem na exchange com a routing key
            $channel->basic_publish($msg, $exchange, $routingKey);

            $channel->close();
            $connection->close();

            \Log::debug('Publicando na fila:', [
                'exchange' => $exchange,
                'queue' => $this->queueName,
                'routing_key' => $routingKey,
                'payload' => $this->payload
            ]);
        } catch (\Throwable $e) {
            \Log::error('Erro ao enviar mensagem para RabbitMQ: ' . $e->getMessage());
            throw $e;
        }
        
    }
}
