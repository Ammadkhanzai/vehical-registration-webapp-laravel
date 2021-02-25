<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class AdminLoginController extends Controller
{
    //
      /**
     * Show the login form.
     * 
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        
        $this->middleware('guest:admin')->except('logout');
    } 
    public function showLoginForm()
    {
        return view('excise.login');
    }

    /**
     * Login the admin.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        //Validation...
        $this->validator($request);
    
        if(Auth::guard('admin')->attempt($request->only('email','password'),$request->filled('remember'))){
            
            //Authentication passed...
            return redirect()
                ->route('admin.home')
                ->with('status','You are Logged in as Admin!');
        }
    
        //Authentication failed...
        return $this->loginFailed();
    }

    /**
     * Logout the admin.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
      //logout the admin...
      Auth::guard('admin')->logout();
      return redirect()
          ->route('admin.login')
          ->with('status','Admin has been logged out!');
    }

    /**
     * Validate the form data.
     * 
     * @param \Illuminate\Http\Request $request
     * @return 
     */
    private function validator(Request $request)
    {
      //validate the form...
          //validation rules.
        $rules = [
            'email'    => 'required|email|exists:admins|min:5|max:191',
            'password' => 'required|string|min:4|max:255',
        ];

        //custom validation error messages.
        $messages = [
            'email.exists' => 'These credentials do not match our records.',
        ];

        //validate the request.
        $request->validate($rules,$messages);
    }

    /**
     * Redirect back after a failed login.
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    private function loginFailed()
    {
      //Login failed...
      
      return redirect()
      ->back()
    //   ->withInput()
    //   ->with();
      ->withInput()->withErrors(['Login failed, please try again!']);
    }
}
