<?php

namespace App\Http\Middleware;

use Closure;

class IsFinalJudge
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
        // $finallist_judge = array(
        //     "216","217","218","219"
        // );
        
        $currentURL = app()->router->getCurrentRoute()->uri ;

        $judgeURL = 'final';

        if (\Auth::user()->isFinalJudge() && $currentURL == $judgeURL ) {
            
            return $next($request);

        } else if (\Auth::user()->isFinalJudge()) {
           
            return redirect('/final');

        };
          return redirect('/');

        // if (\Auth::user()->isFinalJudge()) {
        //     // return redirect('admin');
        //     return $next($request);
        // }
        //   return redirect('/');
    }
}
