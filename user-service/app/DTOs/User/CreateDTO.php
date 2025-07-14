<?php

namespace App\DTOs\User;

class CreateDTO {

    public function __construct(
        public readonly string $document,
        public readonly string $name,
        public readonly string $phone,
        public readonly string $email,
        public readonly string $password,
        public readonly string $role,
    ) {}

    public static function fromArray($request): self
    {
        return new self (
            document: $request["document"],
            name: $request["name"],
            phone: $request["phone"],
            email: $request["email"],
            password: $request["password"],
            role: $request["role"]
        );
    }

    public function toArray(): array
    {
        return [
            'document' => $this->document,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role
        ];
    }
}