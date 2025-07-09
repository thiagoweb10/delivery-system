<?php

namespace App\Services;

use App\DTOs\Auth\LoginUserDTO;
use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LoginUserAction;

class AuthService
{
    public function __construct(
        protected LoginUserAction $loginUserAction
    ) {}

    public function login(LoginUserDTO $dto): array
    {
        $token = $this->loginUserAction->execute($dto);
        $user = auth('api')->user()->load('roles');
        
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => $user
        ];
    }
}