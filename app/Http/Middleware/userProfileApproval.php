<?php

namespace App\Http\Middleware;

use Closure;
use App\User_profile;
use Illuminate\Support\Facades\Auth;

class userProfileApproval
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
        $UP = new User_profile();
        if (Auth::check()) {
            if(!Auth::user()->role()->where('role_id', "1" )->exists()){
                return abort(404);
            }
            // if(!$UP->where('is_active','true')->where('user_id',Auth::user()->id)->exists()){
            //     return abort(404);
            // }
        }
        return $next($request);
    }
}
