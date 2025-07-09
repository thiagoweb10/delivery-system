<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\AuthService;
use App\DTOs\Auth\LoginUserDTO;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Exceptions\Auth\InvalidCredentialsException;

class AuthApiController extends Controller
{
    use ApiResponseTrait;

    public function __construct(protected AuthService $authService) {}
    
    public function login(LoginRequest $request): JsonResponse
    {
        try {

            $dto = LoginUserDTO::fromArray(
                $request->only(['email', 'password'])
            );

            return $this->successResponse(
                $this->authService->login($dto),
                'Login realizado com sucesso!'
            );
            
        } catch (InvalidCredentialsException $e) {
            return $this->errorResponse($e->getMessage());
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }

    }

    public function me(Request $request): JsonResponse
    {
        return $this->successResponse($request->user(), '');
    }

    public function logout($user): JsonResponse
    {
        $this->logoutUserAction->execute($user);

        return $this->successResponse('Logout realizado com sucesso!');
    }
}
