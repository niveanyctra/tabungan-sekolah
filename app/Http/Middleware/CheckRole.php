<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param string $role
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        if ($role == 'superadmin' && auth()->user()->role_id != 1) {
            abort(403);
        }
        if ($role == 'admin' && auth()->user()->role_id != 2) {
            abort(403);
        }
        if ($role == 'hov' && auth()->user()->role_id != 3) {
            abort(403);
        }
        if ($role == 'ht' && auth()->user()->role_id != 4) {
            abort(403);
        }
        if ($role == 'user' && auth()->user()->role_id != 5) {
            abort(403);
        }
        return $next($request);
    }
}
