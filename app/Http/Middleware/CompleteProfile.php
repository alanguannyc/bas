<?php

namespace App\Http\Middleware;

use Closure;

class CompleteProfile
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
        
        if(!\Auth::user()->profile || !\Auth::user()->profile->company) {
            // return redirect()->intended('/admin');
            return redirect('/dashboard/profile');
        }
        return $next($request);
    }
}
