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

        $record = \DB::table('password_reset_tokens')->where('email', $dto->email)->first();

        \Log::info('Verificação de token', [
            'dto_token' => $dto->token,
            'db_token' => $record?->token,
            'match' => $record ? \Hash::check($dto->token, $record->token) : false,
        ]);


        $status = Password::reset(
            [
                'email' => $dto->email,
                'password' => $dto->password,
                'password_confirmation' => $dto->password_confirmation,
                'token' => $dto->token,
            ],
            function ($user, $password) {
                \Log::info('Entrou no callback do reset');
                \Log::info('Senha recebida no callback reset', ['password' => $password]);

                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => \Str::random(60),
                ])->save();

                \Log::info('Senha salva no banco', ['password_hashed' => $user->password]);

                event(new \Illuminate\Auth\Events\PasswordReset($user));
            }
        );

        \Log::info('Status do Password::reset', ['status' => $status]);

        if ($status !== Password::PASSWORD_RESET) {
            throw new InvalidResetTokenException('Token inválido ou expirado.');
        }

        return [
            'email' => $dto->email,
            'type' => 'user.password-reset-success',
        ];
    }
}