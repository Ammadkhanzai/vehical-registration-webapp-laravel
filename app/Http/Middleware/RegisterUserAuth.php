<?php

namespace App\Http\Middleware;
use App\User;
use App\User_role_join;
use Closure;

class RegisterUserAuth
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

        if(User::where('cnic', '=', $request->cnic)->exists()){
            $data = User::where('cnic','=', $request->cnic)->get();
            foreach($data as $row):
                $user_id = $row->id;
            endforeach;  
            if(User_role_join::where(['user_id'=>$user_id ,'role_id'=> $request->role ])->exists()){
                return back()->withErrors(['User already registered with this role.']);
            }
        }

        return $next($request);
    }
}
