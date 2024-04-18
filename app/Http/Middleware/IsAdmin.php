<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check if the user is authenticated and has admin privileges
        if ($request->user() && $request->user()->admin) {
            return $next($request);
        }

        // If not an admin, return unauthorized response
        return abort(403, 'User is not an admin');
    }
}