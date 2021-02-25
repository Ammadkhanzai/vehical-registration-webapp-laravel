<?php

namespace App\Http\Middleware;

use Closure;
use App\Manufacturer_profile;
use Illuminate\Support\Facades\Auth;

class manufacturerProfileApproval
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
        
        $MP = new Manufacturer_profile();
        if (Auth::check()) {
            if(!Auth::user()->role()->where('role_id', "3" )->exists()){
                return abort(404);
            }
            if(!$MP->where('is_active','true')->where('user_id',Auth::user()->id)->exists()){
                return abort(404);
            }
        }
        
        return $next($request);
    }
}
