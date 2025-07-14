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
            $channel->queue_declare($this->queueName, false, true, false, false);

            $msgBody = json_encode($this->payload);
            $msg = new AMQPMessage($msgBody, ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);

            $channel->basic_publish($msg, '', $this->queueName);

            $channel->close();
            $connection->close();
            
        } catch (\Throwable $e) {
            \Log::error('Erro ao enviar mensagem para RabbitMQ: ' . $e->getMessage());
            throw $e;
        }
        
    }
}
