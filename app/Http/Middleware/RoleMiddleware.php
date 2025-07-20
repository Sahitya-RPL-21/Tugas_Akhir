<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }

        $userRole = Auth::user()->role;

        $allowedRoles = array_map('trim', explode('|', $role));

        // Check if the user's role is in the array of allowed roles
        if (!in_array($userRole, $allowedRoles)) {
            abort(403, 'Unauthorized');
        }
        return $next($request);
    }
}
