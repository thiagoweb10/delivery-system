<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\App;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticateService
{
    public function handle($request, \Closure $next)
    {
        try {
            $payload = JWTAuth::parseToken()->getPayload();
            $userId = $payload['sub'] ?? null;

            $request->attributes->add(['jwt_payload' => $payload->toArray()]);

            // Salva userId para o helper funcionar
            App::instance('userId', $userId);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token inválido ou ausente'], 401);
        }

        return $next($request);
    }
}
