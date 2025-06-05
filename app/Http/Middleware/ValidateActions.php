<?php

namespace App\Http\Middleware;

use App\Traits\ValidatesPermissions;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class ValidateActions {

    use ValidatesPermissions;

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        $route = $request->route();
        $permissions = $route?->defaults['permissions'] ?? [];
        $permissions = array_map('intval', $permissions);
        self::HasPermissions($permissions, true);
        return $next($request);
    }
}
