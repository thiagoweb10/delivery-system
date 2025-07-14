<?php

namespace App\DTOs\Auth;

class ResetPasswordDTO
{
    public function __construct(
        public string $token,
        public string $email,
        public string $password,
        public string $password_confirmation
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            $data['token'],
            $data['email'],
            $data['password'],
            $data['password_confirmation'] ?? $data['password']
        );
    }
}
