<?php

namespace App\Http\Controllers;

use App\Admin;
use App\User_profile;
use App\Dealer_profile;
use Illuminate\Http\Request;
use App\Manufacturer_profile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;



class AdminHomeController extends Controller
{
    //
    public function index(){
        
        $admin = new Admin();
        return view('excise.dashboard')->with('userModel',$admin->firstorFail());
    }
    

    public function updateProfile(Request $request){
        
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'newPassword' => [
                            'required',
                            'regex:/^\S*$/u',
                            'min:10',             // must be at least 10 characters in length
                            'regex:/[a-z]/',      // must contain at least one lowercase letter
                            'regex:/[A-Z]/',      // must contain at least one uppercase letter
                            'regex:/[0-9]/',      // must contain at least one digit
                            'regex:/[@$!%*#?&"]/', 
            ],
            'confPassword'=> 'required_with:password|same:newPassword'
        ],
        [
            'password.regex'=> 'Password must contain at least one lowercase, uppercase, digit and special character.',
            'role.max'=>'Invalid Role',
            'role.min'=>'Invalid Role',
            'role.digits'=>'Invalid Role',
        ]);   
        
        $admin = new Admin();
        $adminModel = $admin->first();
        $adminModel->email = $request->email;
        $adminModel->password = Hash::make($request->password);
        $save = $adminModel->save();
        if($save):
            return back()->with('status', 'Profile hasbeen updated successfully.');
        endif;
        return back()->withErrors(['something went wrong.']);

    }


    public function dealerProfileApprovalsView(){
        $dealerModel =  new Dealer_profile();
        $dealers = $dealerModel->where(['is_active'=>'false','approval'=>'true'])
                    ->with('fetchforadmin')
                    ->get();
        // dd($dealers);
        return view('excise.dealer-profile-approval')->with('dealers',$dealers);
        
    }
    public function uniqidReal($lenght = 32) {
        // uniqid gives 13 chars, but you could adjust it to your needs.
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $lenght);
    }
    public function dealerProfileApprove(Request $request){
        
        $request->validate([
            'profile-id' => 'required|numeric', 
            'status'=> 'required|boolean',
        ]);  
        $input = $request->only(['profile-id', 'status']);
        // dd($request->all());
        $dealerModel =  new Dealer_profile();
        $registraion_no = 'DEALER_'.$this->uniqidReal();
        $dealer = $dealerModel->where(['is_active'=>'false','approval'=>'true','id'=>$input['profile-id'] ])->firstorFail();
        $dealer->approval = 'false';
        $dealer->is_active = ($input['status'] == 1)?"true":"false";
        $dealer->registration_date = ($input['status'] == 1)?now():null;
        $dealer->business_registration_no = ($input['status'] == 1)?$registraion_no:null;
        $requestAPI = $this->registerEnroll($registraion_no,'dealer');
        if($requestAPI){
            $save = $dealer->save();
            if($save):
                return back()->with('status', 'Profile has been approved successfully');
            endif;
            return back()->withErrors(['something went wrong after generating cryptomaterial.']); 
        }
        return back()->withErrors(['Dealer is not enrolled in Network.']);                 
    }

    public function manufacturerProfileApprovalsView(){
        $manufactureModel =  new Manufacturer_profile();
        $manufacturers = $manufactureModel->where(['is_active'=>'false','approval'=>'true'])
                    ->with('fetchforadmin')
                    ->get();
        return view('excise.manufacturer-profile-approval')->with('manufacturers',$manufacturers);
        
        
    }
    public function manufacturerProfileApprove(Request $request){
        $request->validate([
            'profile-id' => 'required|numeric', 
            'status'=> 'required|boolean',
        ]);  
        $input = $request->only(['profile-id', 'status']);
        $manufactureModel =  new Manufacturer_profile();
        $manufacture = $manufactureModel->where(['is_active'=>'false','approval'=>'true','id'=>$input['profile-id'] ])->firstorFail();
        $registraion_no = 'MANUFACTURE_'.$this->uniqidReal();
        $manufacture->approval = 'false';
        $manufacture->is_active = ($input['status'] == 1)?"true":"false";
        $manufacture->registration_date = ($input['status'] == 1)?now():null;
        $manufacture->company_registration_no = ($input['status'] == 1)?$registraion_no:null;
        $requestAPI = $this->registerEnroll($registraion_no,'manufacturer');
        if($requestAPI){
            $save = $manufacture->save();
            if($save):
                return back()->with('status', 'Profile has been approved successfully');
            endif;
            return back()->withErrors(['something went wrong after generating cryptomaterial.']); 
        }
        return back()->withErrors(['Manufacturer is not enrolled in Network.']); 
    }

    public function userProfileApprovalsView(){
        $userModel =  new User_profile();
        $users = $userModel->where(['is_active'=>'false','approval'=>'true'])
                    ->with('fetchforadmin')
                    ->get();
        // dd($users);
        return view('excise.user-profile-approval')->with('users',$users);

    }
    public function userProfileApprove(Request $request){
        $request->validate([
            'profile-id' => 'required|numeric', 
            'status'=> 'required|boolean',
        ]);  
        $input = $request->only(['profile-id', 'status']);
        // dd($request->all());
        $userModel =  new User_profile();
        $registraion_no = 'USER_'.$this->uniqidReal();
        $users = $userModel->where(['is_active'=>'false','approval'=>'true','id'=>$input['profile-id'] ])->firstorFail();
        $users->approval = 'false';
        $users->is_active = ($input['status'] == 1)?"true ":"false";
        $users->registration_date = ($input['status'] == 1)?now():null;
        $users->user_registration_no = ($input['status'] == 1)?$registraion_no: null;
        $requestAPI = $this->registerEnroll($registraion_no,'excise');
        if($requestAPI){
            $save = $users->save();
            if($save):
                return back()->with('status', 'Profile has been approved successfully');
            endif;
            return back()->withErrors(['something went wrong after generating cryptomaterial.']); 
        }
        return back()->withErrors(['User is not enrolled in Network.']); 
        
    }


    public function dealerProfileView(){
        $dealerModel =  new Dealer_profile();
        $dealers = $dealerModel->where(['is_active'=>'true'])
                    ->get();
        return view('excise.dealer-profile')->with('dealers',$dealers);
    }
    public function dealerProfileDetailsView($id){
        $dealerModel =  new Dealer_profile();
        $dealer = $dealerModel->where(['is_active'=>'true','id'=>$id])
                    ->firstorFail();
        return view('excise.show-dealer')->with('dealer',$dealer);
    }
    public function manufacturerProfileView(){
        $manufactureModel =  new Manufacturer_profile();
        $manufacturer = $manufactureModel->where(['is_active'=>'true'])
                    ->get();
        return view('excise.manufacturer-profile')->with('manufacturers',$manufacturer);
    }
    public function manufacturerProfileDetailsView($id){
        $manufactureModel =  new Manufacturer_profile();
        $manufacturer = $manufactureModel->where(['is_active'=>'true','id'=>$id])
                                         ->firstorFail();
        return view('excise.show-manufacturer')->with('manufacturer',$manufacturer);

    }
    public function userProfileView(){
        $userModel =  new User_profile();
        $users = $userModel->where(['is_active'=>'true'])
                    ->get();
        return view('excise.user-profile')->with('users',$users);
    }
    public function userProfileDetailsView($id){
        $userModel =  new User_profile();
        $user = $userModel->where(['is_active'=>'true','id'=>$id])
                    ->firstorFail();
        return view('excise.show-user')->with('user',$user);
    }
    public function registerEnroll($userRegistionNo,$organization){

        $data = ['username'=>$userRegistionNo,'orgName'=>$organization];
        $guzzle = new \GuzzleHttp\Client;
        $res = $guzzle->request('POST', 'http://localhost:4000/users', [
            'headers'   => ['Accept'=>'application/json','Content-Type'=>'application/json'],
            'body'      => json_encode($data),
        ]);
        if($res->getStatusCode() == 200){
            return true;
        }
        return false;
    }




    public function data(){
        
        $guzzle = new \GuzzleHttp\Client;
        $login = $guzzle->request('POST', 'http://localhost:4000/users/login', [
                        'form_params' => ['username'=>'MANUFACTURE_9395185570f5fe1e89e67e1d30d7e5d3','orgName' =>'manufacturer']
                        ]);
        if($login->getStatusCode() != 200){
            return false;
        }    
        $m = $login->getBody(); 
        $m2 = json_decode($m);
        $token = $m2->message->token;
        
        $data = [
            'username'  =>  'MANUFACTURE_9395185570f5fe1e89e67e1d30d7e5d3',
            'orgName'   =>  'manufacturer',
            'fcn'       =>  'GetAssetHistory',
            'chaincodeName' => 'vrschaincode',
            'channelName' => 'vrschannel',
            'args'        =>  [md5(45)]
        ];

        
        $response = $guzzle->request('POST', 'http://localhost:4000/channels/vrschannel/chaincodes/vrschaincode', [
            'headers'   => [
                'Accept'=>'application/json',
                'Content-Type'=>'application/json',
                'Authorization'=> 'Bearer '.$token
            ],
            'body'      => json_encode($data),
        ]);
        echo $response->getStatusCode()."<br>";
        echo $response->getHeader('content-type')[0]."<br>";
        echo $response->getBody()."<br>"; 
        dd($response);
        
        // dd($login);
        
    }
}
