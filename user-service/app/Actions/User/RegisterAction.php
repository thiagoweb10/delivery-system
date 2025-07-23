<?php

namespace App\Actions\User;

use App\DTOs\User\CreateDTO;
use App\Services\RegisterService;
use App\Services\RabbitMQPublisher;

class RegisterAction {

    public function __construct(
        public RegisterService $registerService
    ){}

    public function execute(array $data)
    {
        $dto = CreateDTO::fromArray($data);
        $user = $this->registerService->register($dto);

        $publisher = app(RabbitMQPublisher::class);

        $publisher->publish('user.welcome',[
            'user_name'  => $user->name,
            'user_email' => $user->email,
            'user_type'  => $user->getRoleNames()->first(),
        ]);

        return $user;
    }
}