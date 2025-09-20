<?php

namespace App\Http\Controllers\Api\Auth;

use App\Actions\Auth\SendResetLinkAction;
use App\DTOs\Auth\SendResetLinkDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SendResetLinkRequest;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;

class SendResetLinkApiController extends Controller
{
    use ApiResponseTrait;

    public function sendLink(
        SendResetLinkRequest $request,
        SendResetLinkAction $action
    ): JsonResponse {
        try {
            $dto = SendResetLinkDTO::fromArray($request->validated());

            $action($dto);

            return $this->successResponse(
                $action($dto), 'Token de redefinição de senha enviado com sucesso.'
            );
        } catch (\Exception $e) {
            return $this->errorResponse('Um erro inesperado:'.$e->getMessage());
        }
    }
}
