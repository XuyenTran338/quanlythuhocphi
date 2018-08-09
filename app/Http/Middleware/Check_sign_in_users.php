<?php

namespace App\Http\Middleware;

use Closure;

class Check_sign_in_users
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
        if(!session()->has('users'))
        {
            return redirect()->route('login_user');
        }
        return $next($request);
    }
}
