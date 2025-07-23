<?php

namespace App\Services;

use App\DTOs\Auth\ResetPasswordDTO;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Exceptions\Auth\InvalidResetTokenException;


class ResetPasswordService
{
    public function resetPassword(ResetPasswordDTO $dto): array
    {
        $status = Password::reset(
            [
                'email' => $dto->email,
                'password' => $dto->password,
                'password_confirmation' => $dto->password_confirmation,
                'token' => $dto->token,
            ],
            function ($user, $password) {

                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => \Str::random(60),
                ])->save();

                event(new \Illuminate\Auth\Events\PasswordReset($user));
            }
        );

        if ($status !== Password::PASSWORD_RESET) {
            throw new InvalidResetTokenException('Token inválido ou expirado.');
        }

        return [
            'email' => $dto->email,
            'type' => 'user.password-reset-success',
        ];
    }
}