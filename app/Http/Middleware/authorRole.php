<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class authorRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(getUser()->role == "author" ){
            return $next($request);
        }else if(getUser()->role == "admin" ){
            return $next($request);
        }else if(getUser()->role == "moderator" ){
            return $next($request);
        }
        else{
            return redirect('/no-access');
        }
    }
}
