<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        // Check if the user is authenticated and has the required role
        if (!Auth::check() || Auth::user()->role !== $role) {
            // Redirect or abort if the user does not have the required role
            return redirect()->route('dashboard')->withErrors('You do not have permission to access this page.');
        }

        return $next($request);
    }
}
