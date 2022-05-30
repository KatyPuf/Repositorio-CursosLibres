<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EditorMiddleware
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
        foreach ( auth()->user()->roles() as $rol)
        {
            if(auth()->check() && $rol == 'editor')
            {
                return $next($request);
            }
        }
      
        return redirect('/');
    }
}
