<?php

namespace App\Http\Controllers\Api\Auth;

use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\DTOs\Auth\ResetPasswordDTO;
use App\Http\Controllers\Controller;
use App\Actions\Auth\ResetPasswordAction;
use App\Http\Requests\Auth\ResetPasswordRequest;

class ResetPasswordApiController extends Controller
{
    use ApiResponseTrait;

    public function __invoke(
        ResetPasswordRequest $request
        ,ResetPasswordAction $action
    ): JsonResponse
    {
        try {

            $dto = ResetPasswordDTO::fromArray($request->validated());
            
            $action($dto);

            return $this->successResponse(
                []
                ,'Senha redefinida com sucesso.'
            );
        } catch (\Throwable $e) {
            return $this->errorResponse('Erro inesperado ao redefinir senha:'.$e->getMessage(), 500);
        }
    }
}