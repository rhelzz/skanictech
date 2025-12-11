<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        if (!auth()->user()->hasAdminAccess()) {
            abort(403, 'Akses ditolak. Anda tidak memiliki izin admin.');
        }

        if (!auth()->user()->isActive()) {
            auth()->logout();
            return redirect()->route('login')
                ->with('error', 'Akun Anda belum diaktifkan atau telah dinonaktifkan. Silakan hubungi Super Admin.');
        }

        return $next($request);
    }
}
