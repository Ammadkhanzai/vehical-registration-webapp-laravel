<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */


    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if($guard == "admin"){
                return redirect()->route('admin.home');
            }
            $this->redirectTo($request);
        }

        // if (Auth::guard($guard)->check()) {
        //     // return redirect(RouteServiceProvider::HOME);
        //     if($guard == "admin"){
        //         //user is not authenticated with admin guard.
        //         return redirect()->route('admin.home');
        //     }
        //     return redirect('/');
        // }


        return $next($request);
    }

    protected function redirectTo($request)
    {

        if ($request->role == '1'){
            // $redirectTO = 'user.admin.dashboard';
            return route('user.admin.dashboard');
        }
        if ($request->role == '2'){
            // $redirectTO = 'dealer.admin.dashboard';
            return route('dealer.admin.dashboard');
        }
        if ($request->role == '3'){
            // $redirectTO = 'manufacturer.admin.dashboard';
            return route('manufacturer.admin.dashboard');
        }
        return route('/');
    }

}
