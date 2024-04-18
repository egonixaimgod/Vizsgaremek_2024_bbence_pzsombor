<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming HTTP request and return the response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     public function isAdmin()
     {
         return $this->admin;
     }

    /*public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return abort(403, 'kuirva'); // User not authenticated
        }

        $user = Auth::user();

        // Add debug statement to inspect user object
        dd($user);

        if ($user->isAdmin()) {
            return $next($request);
        }
    
        return abort(403, 'User is not an admin');
    }*/

    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated and has admin privileges
        if ($request->user() && $request->user()->admin) {
            return $next($request);
        }

        // If not an admin, return unauthorized response
        return abort(403, 'Unauthorized');
    }
}

