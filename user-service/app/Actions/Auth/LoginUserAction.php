<?php

namespace App\Actions\Auth;

use App\DTOs\Auth\LoginUserDTO;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\Auth\InvalidCredentialsException;

class LoginUserAction
{
    public function execute(LoginUserDTO $dto): string
    {
        if (! $token = Auth::guard('api')->attempt([
            'email' => $dto->email,
            'password' => $dto->password
        ])) {
            throw new InvalidCredentialsException();
        }

        return $token;
    }
}
