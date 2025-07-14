<?php

namespace App\Exceptions\Auth;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class InvalidResetTokenException extends Exception
{
    protected $message = 'Token inválido ou expirado.';
    protected $code = Response::HTTP_BAD_REQUEST; // 400

    public function __construct(?string $message = null)
    {
        parent::__construct(
            $message ?? $this->message,
            $this->code
        );
    }
}