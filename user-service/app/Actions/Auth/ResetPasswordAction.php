<?php

namespace App\Actions\Auth;

use App\DTOs\Auth\ResetPasswordDTO;
use App\Services\PasswordResetService;
use App\Services\ResetPasswordService;

class ResetPasswordAction
{
    public function __construct(
        protected ResetPasswordService $service
    ) {}

    public function __invoke(ResetPasswordDTO $dto): void
    {
        $this->service->resetPassword($dto);
    }
}
