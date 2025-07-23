<?php

namespace App\Actions\Auth;

use App\Jobs\SendToRabbitMQ;
use App\DTOs\Auth\SendResetLinkDTO;
use App\Services\RabbitMQPublisher;
use App\Services\SendResetLinkService;

class SendResetLinkAction
{
    public function __construct(
        protected SendResetLinkService $service
    ) {}

    public function __invoke(SendResetLinkDTO $dto): array
    {
        $data = $this->service->sendResetLink($dto->email);

        $publisher = app(RabbitMQPublisher::class);

        $publisher->publish('user.sendlinkreset-password', $data);

        return $data;
    }
}
