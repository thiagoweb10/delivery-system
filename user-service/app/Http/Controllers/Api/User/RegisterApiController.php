<?php

namespace App\Http\Controllers\Api\User;

use App\Traits\ApiResponseTrait;
use App\Actions\User\RegisterAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

class RegisterApiController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        private RegisterAction $action
    ) {}

    public function __invoke(StoreRequest $request): JsonResponse
    {
        try {

            $this->action->execute($request->validated());

            return $this->successResponse(
                [],
                'Cadastro realizado com sucesso!'
            );

        } catch (\Exception $e) {
            return $this->errorResponse('Um erro inesperado: '.$e->getMessage(), 500);
        }
    }
}