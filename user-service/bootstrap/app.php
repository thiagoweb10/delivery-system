<?php

use Illuminate\Foundation\Application;
use Spatie\Permission\Middleware\RoleMiddleware;
use App\Exceptions\Admin\PermissionDeniedException;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'check.admin' => \App\Http\Middleware\CheckAdminRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (PermissionDeniedException $e, $request) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ], 403,[], JSON_UNESCAPED_UNICODE);
        });
    })->create();
