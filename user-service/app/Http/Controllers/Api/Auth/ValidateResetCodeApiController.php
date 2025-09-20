<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ValidateResetCodeRequest;
use App\Services\ValidateResetCodeService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class ValidateResetCodeApiController extends Controller
{
    use ApiResponseTrait;

    public function getValidateCode(
        ValidateResetCodeRequest $request,
        ValidateResetCodeService $service,
    ): JsonResponse {
        try {
            $service->execute($request->validated());

            return $this->successResponse(
                [], 'Código válido.'
            );
        } catch (\Exception $e) {
            return $this->errorResponse('Um erro inesperado:'.$e->getMessage());
        }
    }
}
