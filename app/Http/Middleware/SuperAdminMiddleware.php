<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        error_log($roles);
        if( auth()->check() )
        {
            /*if(auth()->user()->hasRole('Super-admin'))
            {
                return $next($request);

            }*/

            if (!$request->user() || !in_array($request->user()->role, $roles)) {
                // Redirect...
                               
                return $next($request);

            }
            
        }
      
        return redirect('/');
    }
}
