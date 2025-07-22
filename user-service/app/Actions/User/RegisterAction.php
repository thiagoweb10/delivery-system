<?php

namespace App\Actions\User;

use App\DTOs\User\CreateDTO;
use App\Jobs\SendToRabbitMQ;
use App\Services\RegisterService;

class RegisterAction {

    public function __construct(
        public RegisterService $registerService
    ){}

    public function execute(array $data)
    {
        $dto = CreateDTO::fromArray($data);
        $user = $this->registerService->register($dto);

        SendToRabbitMQ::dispatch(
            $dto->toArray()
            ,'user.welcome-email'
        )->onQueue('user.welcome-email');

        return $user;
    }
}