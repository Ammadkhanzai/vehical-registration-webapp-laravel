<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\User;
use App\Role;
use App\User_role_join;
use App\Customer_profile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginUserController extends Controller {
    use AuthenticatesUsers;
    
    
    public function __construct(){
        $this->middleware('guest')->except('logout');
    }
    
    public function authenticate(Request $request){

        $request->validate([
                'cnic'=> 'required|digits:13',
                'password' => [
                                'required',
                                'string',
                                'min:10',             // must be at least 10 characters in length
                                'regex:/[a-z]/',      // must contain at least one lowercase letter
                                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                                'regex:/[0-9]/',      // must contain at least one digit
                                'regex:/[@$!%*#?&"]/', 
                ],
                'role' => ['required','digits:1','max:3','min:1'],
            ],
            [
                'password.regex'=> 'Password must contain at least one lowercase, uppercase, digit and special character.',
                'role.max'=>'Invalid Role',
                'role.min'=>'Invalid Role',
                'role.digits'=>'Invalid Role',
            ]
        );        

        // $credentials = $request->only('cnic', 'password' , 'role');
        if (Auth::attempt(['cnic' => $request->cnic, 'password' => $request->password] )) {
            // Authentication passed...
            if(!Auth::user()->role()->where('role_id', $request->role )->exists()){
                Auth::logout();
                return back()->withInput()->withErrors(['Invalid Login Details!']);
   
            }
            $redirectTO = "/";
            if ($request->role == '1'){
                $redirectTO = 'user.admin.dashboard';
            }
            if ($request->role == '2'){
                $redirectTO = 'dealer.admin.dashboard';
            }
            if ($request->role == '3'){
                $redirectTO = 'manufacturer.admin.dashboard';
            }
            return redirect()->route($redirectTO);
            
    
        }
        return back()->withInput()->withErrors(['Invalid Login Details!']);

    }

    public function logout() {
        Auth::logout();
        return redirect('/user-login');
    }

    // protected function cycleRememberToken(AuthenticatableContract $user){
    //     $user->setRememberToken($token = Str::random(60));

    //     $this->provider->updateRememberToken($user, $token);
    // }
}
