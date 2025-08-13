<?php

namespace App\Exceptions;

class UnauthorizedActionException extends \Exception
{
    public function __construct(string $message = 'Ação não autorizada.')
    {
        parent::__construct($message);
    }
}
