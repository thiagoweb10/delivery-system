<?php

namespace App\Exceptions\Admin;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class PermissionDeniedException extends Exception
{
    protected $message = 'Usuário não tem permissão para acessar este recurso.';
    protected $code = Response::HTTP_FORBIDDEN; // 403

    public function __construct()
    {
        parent::__construct(
            $this->message,
            $this->code
        );
    }
}
