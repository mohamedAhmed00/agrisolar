<?php

namespace Modules\FrontEnd\Http\Middleware;

use Closure;

class authCheck
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
        if(!empty(auth()->user()))
        {
            return redirect('/dashboard');
        }
        return $next($request);
    }
}
