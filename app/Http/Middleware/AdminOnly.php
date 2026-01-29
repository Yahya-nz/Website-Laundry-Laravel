<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminOnly
{
    /**
     * Handle an incoming request.
     * Allow access to users with 'admin' or 'staff' role.
     */
    public function handle($request, Closure $next)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            abort(403, 'ANDA TIDAK MEMILIKI AKSES SEBAGAI ADMIN.');
        }

        // Allow both admin and staff roles
        $userRole = auth()->user()->role;
        if ($userRole !== 'admin' && $userRole !== 'staff') {
            abort(403, 'ANDA TIDAK MEMILIKI AKSES SEBAGAI ADMIN.');
        }

        return $next($request);
    }
}