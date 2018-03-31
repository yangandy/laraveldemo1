<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Address
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

        $judge=\App\Address::where('user_id',Auth::user()->id)->first();
        if(!$judge){

            return redirect('/address');
        }
        return $next($request);
    }
}
