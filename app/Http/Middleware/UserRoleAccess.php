<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRoleAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param mixed ...$requiredRoles
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$requiredRoles)
    {

        // TODO: change yourself
        if (!auth()->check()) abort(403, 'U must login to use role middleware');

        $userRoles = $request->user()->roles->pluck('sku')->toArray();

        abort_if(0 === count(array_intersect($requiredRoles, $userRoles)), 403);

        return $next($request);
    }
}
