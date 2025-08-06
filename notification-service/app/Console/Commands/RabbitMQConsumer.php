<?php

namespace App\Console\Commands;

use App\Mail\SendLinkTokenReset;
use App\Mail\SendUserWelcome;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMQConsumer extends Command
{
    protected $signature = 'rabbitmq:consume';
    protected $description = 'Consumindo mensagem do RabbitMQ';

    public function handle()
    {
        $host = env('RABBITMQ_HOST', 'rabbitmq');
        $port = env('RABBITMQ_PORT', 5672);
        $user = env('RABBITMQ_USER', 'guest');
        $password = env('RABBITMQ_PASSWORD', 'guest');
        $exchange = env('RABBITMQ_EXCHANGE', 'user.process');

        $connection = new AMQPStreamConnection($host, $port, $user, $password);
        $channel = $connection->channel();

        $channel->exchange_declare($exchange, 'direct', false, true, false);

        $queue1 = 'user.welcome-email';
        $channel->queue_declare($queue1, false, true, false, false);
        $channel->queue_bind($queue1, $exchange, 'user.welcome');

        $queue2 = 'user.sendlinkreset-password';
        $channel->queue_declare($queue2, false, true, false, false);
        $channel->queue_bind($queue2, $exchange, 'user.sendlinkreset-password');

        $this->info(' [*] Aguardando mensagens. Para sair, pressione CTRL+C');

        $callback = function (AMQPMessage $msg) {
            $data = json_decode($msg->body, true);
            $routingKey = $msg->getRoutingKey();

            $this->info('Mensagem recebida com delivery tag: '.$msg->delivery_info['delivery_tag']);

            $this->info("Mensagem recebida na fila '{$routingKey}':");
            dump($routingKey);

            if (!isset($data['data']['command'])) {
                $this->error("Campo 'data.command' ausente.");
                $msg->ack();

                return;
            }

            $commandObject = @unserialize($data['data']['command'], ['allowed_classes' => false]);

            if (!$commandObject) {
                $this->error('Falha ao desserializar o objeto.');
                $msg->ack();

                return;
            }

            $objectVars = get_object_vars($commandObject);

            if (!isset($objectVars['payload'])) {
                $this->error('Payload não encontrado no objeto desserializado.');
                $msg->ack();

                return;
            }

            $data = $objectVars['payload'];
            dump($data);

            try {
                match ($routingKey) {
                    'user.sendlinkreset-password' => Mail::to($data['email'])->send(new SendLinkTokenReset($data)),
                    'user.welcome-email' => Mail::to($data['email'])->send(new SendUserWelcome($data)),
                    default => $this->warn("Fila '{$routingKey}' não tratada."),
                };

                $msg->ack();
            } catch (\Throwable $e) {
                $this->error('Erro ao enviar e-mail: '.$e->getMessage());
            }
        };

        $channel->basic_consume($queue1, '', false, false, false, false, $callback);
        $channel->basic_consume($queue2, '', false, false, false, false, $callback);

        while ($channel->is_consuming()) {
            $channel->wait();
        }
    }
}
