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
    public function __construct(public array $userData)
    {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $connection = new AMQPStreamConnection(
            env('RABBITMQ_HOST', 'localhost'),
            env('RABBITMQ_PORT', 5672),
            env('RABBITMQ_USER', 'guest'),
            env('RABBITMQ_PASS', 'guest')
        );

        $channel = $connection->channel();

        // Declara a fila (cria se não existir)
        $queueName = env('RABBITMQ_QUEUE', 'minha_fila_exemplo');
        $channel->queue_declare($queueName, false, true, false, false);

        // Cria a mensagem JSON
        $msgBody = json_encode($this->userData);
        $msg = new AMQPMessage($msgBody, ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);

        // Envia a mensagem para a fila
        $channel->basic_publish($msg, '', $queueName);

        // Fecha conexão e canal
        $channel->close();
        $connection->close();
    }
}
