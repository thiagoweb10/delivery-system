<?php

namespace Tests\Helpers;

use Firebase\JWT\JWT;

class JwtTestHelper
{
    public static function generate(array $payload = []): string
    {
        $key = env('JWT_SECRET', 'secret'); // mesma chave do serviço
        $defaultPayload = [
            'sub' => 1,          // user_id
            'role' => 'courier', // role do usuário
            'iat' => time(),
            'exp' => time() + 3600,
        ];

        $payload = array_merge($defaultPayload, $payload);

        return JWT::encode($payload, $key, 'HS256');
    }
}
