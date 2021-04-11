<?php

namespace App\Http\Middleware;

use Closure;
use App\Dealer_profile;
use Illuminate\Support\Facades\Auth;

class dealerProfileApproval
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
        $DP = new Dealer_profile();
        if (Auth::check()) {
            if(!Auth::user()->role()->where('role_id', "2" )->exists()){
                
                return abort(404);
            }
            // if(!$DP->where('is_active','true')->where('user_id',Auth::user()->id)->exists()){
                
            //     return abort(404);  
            // }
        }
        return $next($request);
    }
}
