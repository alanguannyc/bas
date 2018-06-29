<?php

namespace App\Http\Middleware;

use Closure;

class SimplePassword
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
        $uid = auth()->user()->id;
        if(auth()->user()->id == '1') {
            
            return redirect('/final' . '/' . $uid);
        }
        return $next($request);
    }
}
