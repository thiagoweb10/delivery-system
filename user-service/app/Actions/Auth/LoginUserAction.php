<?php

namespace App\Actions\Auth;

use App\DTOs\Auth\LoginUserDTO;
use App\Exceptions\Auth\InvalidCredentialsException;
use Illuminate\Support\Facades\Auth;

class LoginUserAction
{
    public function execute(LoginUserDTO $dto): string
    {
        /*
            if (! $token = Auth::guard('api')->attempt([
                'email' => $dto->email,
                'password' => $dto->password
            ])) {
                throw new InvalidCredentialsException();
            }
        */

        $credentials = [
            'email' => $dto->email,
            'password' => $dto->password,
        ];

        if (!$user = Auth::guard('api')->getProvider()->retrieveByCredentials($credentials)) {
            throw new InvalidCredentialsException();
        }

        if (!Auth::guard('api')->validate($credentials)) {
            throw new InvalidCredentialsException();
        }

        $role = $user->getRoleNames()->first() ?? null;

        $token = Auth::guard('api')->claims([
            'role' => $role,
        ])->login($user);

        return $token;
    }
}
