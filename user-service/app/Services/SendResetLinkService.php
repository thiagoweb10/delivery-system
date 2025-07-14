<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Password;
use App\Exceptions\Auth\InvalidResetTokenException;
use Illuminate\Support\Facades\Hash;

class SendResetLinkService
{
    public function sendResetLink(string $email): array
    {
        $user = User::email($email)->first();

        if (is_null($user)) {
            throw new InvalidResetTokenException("Usuário com e-mail {$email} não encontrado.");
        }

        $token = Password::createToken($user);

        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $email],
            [
                'token' => Hash::make($token),
                'created_at' => now(),
            ]
        );

        return [
            'name' => $user->name
            ,'email' => $user->email
            ,'token' => $token
        ];
    }
}
