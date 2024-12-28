<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the logged-in user has the 'admin' role
        if (Auth::check() && Auth::user()->role !== 'admin') {
            // Redirect to home or any other route if not an admin
            return redirect('/');
        }

        // Continue with the request if the user is an admin
        return $next($request);
    }
}
