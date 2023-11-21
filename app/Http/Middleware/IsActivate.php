<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsActivate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    protected function handle(Request $request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->state == 1) {
            return $next($request);
        }

        return redirect('/')->with('error', 'Votre compte a été désactivé');
    }
}
