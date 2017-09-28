<?php

namespace App\Http\Middleware;

use Closure;

class IsConsult
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
        if(Auth::user()->typeUser_id != 2){
            return redirect()->back();
        }
        return $next($request);
    }
}
