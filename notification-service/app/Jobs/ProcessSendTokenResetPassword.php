<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessSendTokenResetPassword implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $payload;

    public function __construct(array $payload)
    {
        $this->payload = $payload;
    }

    public function handle(): void
    {
        // Exemplo: logar ou enviar e-mail
        \Log::info('Mensagem recebida do RabbitMQ', $this->payload);

        // Você pode enviar email aqui, ex:
        // Mail::to($this->payload['email'])->send(new WelcomeMail($this->payload));
    }
}
