<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param string $status
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $status): Response
    {
        if ($status == 'false' && auth()->check() && auth()->user()->status == false) {
            return redirect('waiting');
        }
        if ($status == 'true' && auth()->check() && auth()->user()->status == true) {
            return redirect()->route('tabungan-sekolah');
        }
        return $next($request);
    }
}
