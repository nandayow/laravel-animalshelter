<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Http\Request;

class CustomAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
         $path=$request->path();
   
        if(($path=="login" || $path=="personnel/create") && Session::get('personnel'))
        {

            return redirect('home')->with('success', 'You are already in a session!'); 

        }else if(($path=="login" || $path=="adopter/create") && Session::get('adopter'))
        {
            return redirect('home')->with('error', 'You are already a member!');

        }else if(($path=="login" || $path=="adopter/create") && Session::get('adopter'))
        {
            return redirect('home')->with('error', 'You are already a member!');

        }else if( !Session::get('personnel') && Session::get('adopter')&& ($path=="animal" || $path=="adopter" ))
        {
            return redirect('home')->with('error', 'You are already a member!');

        }
        
        return $next($request);
    }
}
 