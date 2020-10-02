<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        Auth::shouldUse('usuario'); 
        
        if ($guard == "usuario" && Auth::guard('usuario')->check()) {
            dd(Auth::guard('usuario')->check());
        }

        return $next($request);
        //   if (Auth::guard($guard)->check()) {
        //       return redirect('/home');
        //   }
        //   return $next($request);
               
        //     if (Auth::guard($guard)->check()) {

        //        // dd($log);
        
        //         foreach (config('auth.guards') as $key => $value) {
        //             if($key == $guard) {
        //                 return redirect()->route($value['redirectTo']);
        //             }
        //         }
        //     }

        //    // dd(Auth::guard($guard)->check());
    
        //     return $next($request);
        //dd($guard);
       
    }
    
}
