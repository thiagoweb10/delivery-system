<?php

namespace App\DTOs\Auth;

class SendResetLinkDTO
{
    public function __construct(public string $email) {}

    public static function fromArray(array $data): self
    {
        return new self($data['email']);
    }
}
