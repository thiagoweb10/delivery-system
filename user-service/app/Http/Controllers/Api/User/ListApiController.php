<?php

namespace App\Http\Controllers\Api\User;

use Illuminate\Http\Request;
use App\Actions\User\ListAction;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class ListApiController extends Controller
{
    use ApiResponseTrait;

    public function __invoke(Request $request, ListAction $action): JsonResponse
    {
        try {

            $users = $action($request->all());

            return $this->successResponse(
                $users
                ,'Listagem criada com sucesso!'
            );

        } catch (\Exception $e) {
            return $this->errorResponse('Um erro inesperado: '.$e->getMessage(), 500);
        }
    }
}