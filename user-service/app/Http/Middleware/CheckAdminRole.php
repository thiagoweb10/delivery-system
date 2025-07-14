<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Exceptions\Admin\PermissionDeniedException;

class CheckAdminRole
{
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user()?->hasRole('admin')) {
            throw new PermissionDeniedException();
        }

        return $next($request);
    }
}
