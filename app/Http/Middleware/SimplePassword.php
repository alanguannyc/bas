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
        $finallist_judge = array(
            "216","217","218","219"
        );

        if(in_array($uid, $finallist_judge)) {
            return $next($request);
        }

        return redirect('/' );
    }
}
