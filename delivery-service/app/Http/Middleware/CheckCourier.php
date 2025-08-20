<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class CheckCourier
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, \Closure $next): Response
    {
        $role = App::make('userRole');

        if ($role !== 'courier') {
            return response()->json(['error' => 'Acesso negado: perfil não é entregador'], 403);
        }

        return $next($request);
    }
}
