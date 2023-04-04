<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Session;
class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $user = Auth::user(); 
        // dd($user);

        if($user == null)
        { 
            return redirect()->route('home.index')->with('error','Permission denied'); 
        }  elseif($user->role != 'adopter' && $user->status !='active')
        { 
            return redirect()->route('home.index')->with('error','Permission denied'); 
        } 
        
        

        foreach($roles as $role) {
              // dd($user->hasRole($role));
                if($user->role == $role && $user->statuts !="active")
              { 
                return $next($request); 
              } 
            //   dd($role);
        }
        return redirect()->back()->with('error','Permission denied'); 
    }
}
