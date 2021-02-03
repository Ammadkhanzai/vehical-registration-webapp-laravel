<?php

namespace App\Http\Controllers;


use App\Role;
use App\User;
use App\User_profile;
use App\Dealer_profile;
use App\User_role_join;
use Illuminate\Http\Request;
use App\Manufacturer_profile;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterUserController extends Controller{
    use RegistersUsers;
    public function __construct(){
        $this->middleware('guest');
    }

    public function index(Request $request){  

        $request->validate([
                'cnic'=> 'required|digits:13|unique:users',
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => [
                                'required',
                                'string',
                                'min:10',             // must be at least 10 characters in length
                                'regex:/[a-z]/',      // must contain at least one lowercase letter
                                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                                'regex:/[0-9]/',      // must contain at least one digit
                                'regex:/[@$!%*#?&"]/', 
                ],
                'conf-password' => 'required|max:255|same:password',
                'role' => 'required|digits:1|max:3|min:1',
            ],
            [
                'password.regex'=> 'Password must contain at least one lowercase, uppercase, digit and special character.'
            ]
        );
        
        if (!User::where('cnic', '=', $request->cnic)->exists()){
            $User = new User();
            $User->cnic = $request->cnic;
            $User->email = $request->email;
            $User->password = Hash::make($request->password); 
            $User->status = 'unverified'; // unverified , verified
            $save = $User->save(); 
            if($save){
                $Role = new User_role_join();
                $Role->user_id = $User->id;
                $Role->role_id = $request->role;
                $Role->save();
                if($request->role == "1"){
                    $Profile = new User_profile();
                    $Profile->user_id = $User->id;
                    $Profile->is_active = 'false'; // true , false
                    $save = $Profile->save();
                }elseif($request->role == "2"){
                    $Profile = new Dealer_profile();
                    $Profile->user_id = $User->id;
                    $Profile->is_active = 'false'; // true , false
                    $save = $Profile->save();
                }elseif($request->role == "3"){
                    $Profile = new Manufacturer_profile();
                    $Profile->user_id = $User->id;
                    $Profile->is_active = 'false'; // true , false
                    $save = $Profile->save();
                }
                if($save){
                    return back()->with('status', 'Account successfully created.');
                }else{
                    return back()->withErrors(['something went wrong in code.']);   
                }   
            }
        }
        return back()->withErrors(['Account already Exists.'])->withInput($request->input());
        
   
    }
}
