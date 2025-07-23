<?php

namespace App\Listeners;

use PhpAmqpLib\Message\AMQPMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendLinkResetListener
{
    public function __invoke(AMQPMessage $message)
    {
        $data = json_decode($message->getBody(), true);

        logger()->info('Reeset password email data:', $data);

        // Aqui você chama Mail::to($data['email'])->send() etc.
    }
}
