<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class ManufacturerRoleAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){

        if (Auth::check()) {
            if(!Auth::user()->role()->where('role_id', "3" )->exists()){
                return abort(404);
            }    
        }
        
        return $next($request);
    }
}
