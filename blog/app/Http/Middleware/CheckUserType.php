<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param int $userType
     * @return mixed
     */
    public function handle($request, Closure $next, int $userType)
    {
        if ($request->user()->type === $userType) {
            return $next($request);
        }

        abort(404);
    }
}
