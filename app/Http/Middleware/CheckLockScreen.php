<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLockScreen
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If user is authenticated and session is locked
        if (auth()->check() && session('locked') === true) {
            // Prevent infinite loops if they are already trying to access the lock screen
            if (!$request->routeIs('admin.lock.screen') && !$request->routeIs('admin.lock.unlock')) {
                return redirect()->route('admin.lock.screen');
            }
        }

        return $next($request);
    }
}
