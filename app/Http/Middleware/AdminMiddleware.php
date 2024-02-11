<?php

namespace App\Http\Middleware;

use Auth;
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

        if(Auth::user()->user_type == 'superadmin'){
            return $next($request);
        }
        else if(Auth::user()->user_type == 'admin'){
            return $next($request);
        }
        else if(Auth::user()->user_type == 'agency'){
            return $next($request);
        }
        else if(Auth::user()->user_type == 'trader'){
            return $next($request);
        }
        else if(Auth::user()->user_type == 'factory'){
            return $next($request);
        }
        else{
            return redirect('/login');
        }
    }

}