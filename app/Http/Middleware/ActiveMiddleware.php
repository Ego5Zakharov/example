<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ActiveMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($this->isActive($request)) {
            return $next($request);
        }
        abort(403);
    }

    public function isActive(Request $request): bool
    {
        return true;
    }
}
