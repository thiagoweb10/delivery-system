<?php

namespace App\Actions\Auth;

use App\DTOs\Auth\SendResetLinkDTO;
use App\Jobs\SendToRabbitMQ;
use App\Services\SendResetLinkService;

class SendResetLinkAction
{
    public function __construct(
        protected SendResetLinkService $service
    ) {
    }

    public function __invoke(SendResetLinkDTO $dto): array
    {
        $data = $this->service->sendResetLink($dto->email);

        \Log::info('Email recebido para reset', ['email' => $dto->email]);

        SendToRabbitMQ::dispatch(
            $data, 'user.sendlinkreset-password'
        )->onQueue('user.sendlinkreset-password');

        return $data;
    }
}
