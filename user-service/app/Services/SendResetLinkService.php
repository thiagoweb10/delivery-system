<?php

namespace App\Services;

use App\Exceptions\Auth\InvalidResetTokenException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SendResetLinkService
{
    public function sendResetLink(string $email): array
    {
        $user = User::email($email)->first();

        \Log::info('Email recebido para reset', ['email' => $user->email]);

        if (is_null($user)) {
            throw new InvalidResetTokenException("Usuário com e-mail {$email} não encontrado.");
        }

        $token = rand(10000, 99999);
        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => Hash::make($token),
                'created_at' => now(),
            ]
        );

        return [
            'name' => $user->name, 'email' => $user->email, 'token' => $token,
        ];
    }
}
