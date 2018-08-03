<?php

namespace App\Http\Middleware;

// use Illuminate\Routing\Route;
use Closure;

class IsJudge
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
        
        $users = \App\User::whereHas('roles', function ($query) {
            $query->where('name', 'judge');
        })->orderBy('created_at', 'desc')->get();

        if (app()->router->getCurrentRoute()->parameters) {
            $current_params = app()->router->getCurrentRoute()->parameters['id'];
        } else {
            $current_params = null;
        }
            
   

        // $key = array_search(auth()->user()->id, $users);
        
        $array = array();
        foreach ($users as $key => $value) {
            array_push($array, $value['id']);
            // $array.push($value['id']);
            // if ( auth()->user()->id == $value['id'] ) {
            //     // dd($value['id'] . '' .$key);
            //     // return redirect('/judge' . '/' . $key);
            //     return $next($request);
            // } else {
            //     return redirect('/judge' . '/' . $key);
            // }

         }
         $key = array_search(auth()->user()->id, $array);

         
         if ($current_params == $key) {
            return $next($request);
         } 
            return redirect('/judge' . '/' . $key);
         
        //  $params = array_search(auth()->user()->id, $array);
        
            
        
         
        //  return $next($request);
    }
}
