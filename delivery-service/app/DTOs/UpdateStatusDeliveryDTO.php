<?php

namespace App\DTOs;

class UpdateStatusDeliveryDTO
{
    public function __construct(
        public readonly string $status_id,
        public readonly ?string $notes = null,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new self(
            status_id: $data['status'],
            notes: $data['notes'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status_id,
            'notes' => $this->notes,
        ];
    }
}
