<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\SendLinkTokenReset;
use PhpAmqpLib\Message\AMQPMessage;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class RabbitMQConsumer extends Command
{
    protected $signature = 'rabbitmq:consume';
    protected $description = 'Consume messages from RabbitMQ';

    public function handle()
    {
        $host = env('RABBITMQ_HOST', 'rabbitmq');
        $port = env('RABBITMQ_PORT', 5672);
        $user = env('RABBITMQ_USER', 'guest');
        $password = env('RABBITMQ_PASSWORD', 'guest');
        $exchange = env('RABBITMQ_EXCHANGE', 'user.process');

        $connection = new AMQPStreamConnection($host, $port, $user, $password);
        $channel = $connection->channel();

        // Declara a exchange (caso ainda não exista)
        $channel->exchange_declare($exchange, 'direct', false, true, false);

        // Fila 1: user.welcome
        $queue1 = 'user.welcome';
        $channel->queue_declare($queue1, false, true, false, false);
        $channel->queue_bind($queue1, $exchange, 'user.welcome');

        // Fila 2: user.sendlinkreset-password
        $queue2 = 'user.sendlinkreset-password';
        $channel->queue_declare($queue2, false, true, false, false);
        $channel->queue_bind($queue2, $exchange, 'user.sendlinkreset-password');

        $this->info(' [*] Aguardando mensagens. Para sair, pressione CTRL+C');

        $callback = function (AMQPMessage $msg) {
            $data = json_decode($msg->body, true);
            $routingKey = $msg->delivery_info['routing_key'] ?? '';

            $this->info("Mensagem recebida na fila '{$routingKey}':");
            dump($routingKey);

            if ($routingKey === 'user.sendlinkreset-password') {
                
                $this->info("Enviando e-mail para {$data['email']}...");
                Mail::to($data['email'])->send(new SendLinkTokenReset($data));
                $this->info("E-mail enviado!");
            }

            match ($routingKey) {
                'user.sendlinkreset-password' => Mail::to($data['email'])->send(new SendLinkTokenReset($data)),
                // Você pode adicionar mais casos para outras filas no futuro
                default => $this->warn("Fila '{$routingKey}' não tratada."),
            };
            






            // Aqui você pode chamar serviços para enviar e-mail, notificações, etc.
        };

        // Escuta ambas as filas
        $channel->basic_consume($queue1, '', false, true, false, false, $callback);
        $channel->basic_consume($queue2, '', false, true, false, false, $callback);

        // Loop infinito ouvindo
        while ($channel->is_consuming()) {
            $channel->wait();
        }
    }
}
