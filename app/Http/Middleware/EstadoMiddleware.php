<?php

namespace App\Http\Middleware;

use Closure;

class EstadoMiddleware
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
        if(auth()->user()->estado == 1)
        {
            return $next($request);
        }
        elseif(auth()->user()->estado == 2)
        {
            return redirect()->route('inactivo');
        }
    }
}
