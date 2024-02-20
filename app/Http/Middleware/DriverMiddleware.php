<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DriverMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->user_type == "student") {
            return $next($request);
        } elseif (Auth::check()) {
            // User is authenticated but not a student, redirect them to dashboard
            return redirect('/dashboard');
        } else {
            // User is not authenticated, redirect them to login page
            return redirect('/login');
        }
    }
    
}
