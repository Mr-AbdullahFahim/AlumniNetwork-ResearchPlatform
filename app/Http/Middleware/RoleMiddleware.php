<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response|mixed
     */
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('You must be logged in to access this page.');
        }

        // Check if the user has one of the required roles
        if (!in_array(Auth::user()->role, $roles)) {
            // Redirect to the appropriate page if the user does not have the required role
            return redirect()->route('dashboard')->withErrors('You do not have permission to access this page.');
        }

        return $next($request);
    }
}
