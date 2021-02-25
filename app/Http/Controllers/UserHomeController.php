<?php

namespace App\Http\Controllers;

use App\User;
use App\User_profile;
use Redirect,Response;
use App\Dealer_profile;
use App\Vehical_user_join;
use App\Vehical_dealer_join;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserHomeController extends Controller
{
    //
    public function index(){
        
        $user = new User_profile();
        $profile = $user->where('user_id',Auth::id())->first();
        // dd($profile);
        return view('user.dashboard')->with('userModel',$profile);
        
    }

    public function showDealers(){
        $dealer = new Dealer_profile();
        $dealers = $dealer->all()->where('is_active','true');
        return view('user.dealer')->with('dealers',$dealers);
    }
    public function showReceiveVehicals(){

        
        $vehicals = Vehical_dealer_join::with('vehical_user_join')
                                            ->with('fetchVehical')
                                            ->with('fetchDealer')
                                            ->orderBy('created_at')
                                            ->has('vehical_user_join')
                                            ->has('fetchVehical')
                                            ->has('fetchDealer')
                                            ->get();

        $last = [];        
        foreach($vehicals as $v):
            $lastOwner = Vehical_user_join::where([
                                            'vehical_id'=>$v->vehical_id,
                                            'user_profile_id'=>$v->vehical_user_join->user_profile_id,
                                            ])->with('withLastOwner')->orderBy('created_at')->first();
            $last[] = $lastOwner;                             
        endforeach;
        // dd(array($vehicals,$last));
        return view('user.receive-new-vehical')->with('vehicals',$vehicals )->with('last',$last);
        
    }


    public function receiveVehical(Request $request){
        
        $user = new User_profile();
        $profile = $user->where('user_id',Auth::id())->first();

        $vuj = Vehical_user_join::where([
            'vehical_id'=>$request->id,
            'user_profile_id'=>$profile->id,
            'receive'=>'false'
        ])->firstorFail();

        $response = $this->ReceiveFromDealer(md5($request->id),$profile->user_registration_no);
        if($response){
            $vuj->receive = 'true';
            $vuj->owner = 'true';
            $save = $vuj->save();
            if($save){
                return back()->with('status', 'Vehical successfully received.');
            }
        }
        return back()->withErrors(['something went wrong.']);
    }

    public function showVehicals(){
        
        $user = new User_profile();
        $profile = $user->where('user_id',Auth::id())->first();

        $vehicals = Vehical_user_join::where([
            'user_profile_id'=>$profile->id,
            'receive'=>'true',
            'owner'=>'true',
        ])->with('fetchVehical')->get();

        return view('user.vehical')->with('vehicals',$vehicals);
        
    }
    public function vehical($id){
        $user = new User_profile();
        $profile = $user->where('user_id',Auth::id())->first();

        $vehicals = Vehical_user_join::where([
            'user_profile_id'=>$profile->id,
            'vehical_id'=>$id,
            'receive'=>'true',
            // 'owner'=>'true',
        ])->with('fetchVehical')->firstorFail();
        return view('user.show-vehical')->with('vehical',$vehicals);
    }

    public function showTransferVehical($id){
        $user = new User_profile();
        $profile = $user->where('user_id',Auth::id())->first();

        Vehical_user_join::where([
            'user_profile_id'=>$profile->id,
            'vehical_id'=>$id,
            'receive'=>'true',
            'owner'=>'true',
        ])->with('fetchVehical')->firstorFail();
        
        return view('user.search-for-user')->with('vehical_id',$id);


    }

    public function searchUser(Request $request){
        
        $user = new User();
        $profile = $user->where('id',Auth::id())->first();

        if($request->ajax()){   
            // if(!isset($request->cnic) || !is_numeric($request->cnic) || strlen($request->cnic) != '14' ){
            //     return Response::json(['status' => 'false']);
            // }
            if($request->cnic == $profile->cnic){
                return Response::json(['status' => 'false']);
            }
            
            $response = [];
            $user  = User::with('user_profile')
                            ->where('cnic',$request->cnic)
                            ->first();
            if($user){
                return Response::json(['status' => 'true', 'profile' => $user->user_profile]);                            
            }
        }
        return Response::json(['status' => 'false', 'transfered' => 'successfull']);
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

    public function transferVehical(Request $request){
        
        $user = new User_profile();
        $profile = $user->where('user_id',Auth::id())->first();
        if($profile->id == $request->profile){
            abort(405);   
        }

        $senderProfile = Vehical_user_join::where([
            'user_profile_id'=>$profile->id,
            'vehical_id'=>$request->vehicalID,
            'receive'=>'true',
            'owner'=>'true',
        ])->firstorFail();

        $clientProfile = User_profile::where('id',$request->profile)
                                    ->where('is_active','true')
                                    ->firstorFail();

        $prevProfile = Vehical_user_join::where([
                                                'user_profile_id'=>$request->profile,
                                                'vehical_id'=>$request->vehicalID,
                                                'receive'=>'true',
                                                'owner'=>'false',
                                            ])->first();
        
        $registraion_no = 'VEHICAL_'.$this->uniqidReal();
        $response = $this->ChangeOwner(md5($request->vehicalID),$profile->user_registration_no,$clientProfile->user_registration_no,$clientProfile->first_name.' '.$clientProfile->last_name,time(),$registraion_no);
        
        if(!$response){
            return redirect()->route('user.admin.view.vehicals')->withErrors(['something went wrong.']);
        }
        $senderProfile->owner = 'false';
        $senderProfile->last_owner = null;
        $save = $senderProfile->save();
        
        if($save){
            if($prevProfile != null){
                $prevProfile->receive = 'false';
                $prevProfile->last_owner = $profile->id;
                $prevProfile->save();
                
            }else{
                $sendto = new Vehical_user_join();
                $sendto->vehical_id = $request->vehicalID;
                $sendto->user_profile_id = $request->profile;
                $sendto->receive = "false";
                $sendto->last_owner = $profile->id;
                $sendto->save();
                
            }
            return redirect()->route('user.admin.view.vehicals')->with('status', 'Vehical successfully Transfered.');
        }
        return redirect()->route('user.admin.view.vehicals')->withErrors(['something went wrong.']);
            
    }

    public function transferedVehical(){
        $user = new User_profile();
        $profile = $user->where('user_id',Auth::id())->first();
        $data = Vehical_user_join::where('user_profile_id',$profile->id)
                                    ->where('owner','false')
                                    ->where('receive','true')    
                                    ->get();
        $list = [];
        foreach($data as $v):
            
            $list[] = Vehical_user_join::where('vehical_id',$v->vehical_id)
                                    ->where('last_owner',$profile->id)
                                    ->with('fetchVehical')
                                    ->with('fetchUser')
                                    ->first();
        endforeach;                            
        // dd($list);
        // dd($data);
        return view('user.show-transfered-vehical')->with('list',$list);
    }

    public function updateProfile(Request $request){
        
        $request->validate([
                'firstName'=> 'required|string|max:50',
                'lastName'=> 'required|string|max:50',
                'middleName'=> 'required|string|max:50',
                'fatherName'=> 'required|string|max:50',
                'fatherCnic'=> 'required|string|max:50',
                'dob'=> 'required|string|max:50',
                'nationality'=> 'required|string|max:50',
                'phone'=> 'required|string|max:100',
                'currentAddress'=> 'required|string|max:250',
                'postalAddress'=> 'required|string|max:250',
                'city'=> 'required|string|max:50',
                'state'=> 'required|string|max:50',
                'zip'=> 'required|string|max:10',
                
        ]);
        $user = new User_profile();
        $profile = $user->where('user_id',Auth::id())->where('is_active','false')->firstorFail();
        $profile->first_name = $request->firstName;
        $profile->last_name = $request->lastName;
        $profile->middle_name = $request->middleName;
        $profile->father_name = $request->fatherName;
        $profile->father_cnic = $request->fatherCnic;
        $profile->dob = $request->dob;
        $profile->nationality = $request->nationality;
        $profile->phone = $request->phone;
        $profile->current_address = $request->currentAddress;
        $profile->postal_address = $request->postalAddress;
        $profile->city = $request->city;
        $profile->state = $request->state;
        $profile->zip = $request->zip;
        $profile->approval = "true";
        $save = $profile->save();
        if($save){
            return back()->with('status', 'Profile updated successfully .');
        }
        return back()->withErrors(['something went wrong.']);
    }

    private function ReceiveFromDealer($assetID,$userID){
        
        $guzzle = new \GuzzleHttp\Client;
        $login = $guzzle->request('POST', 'http://localhost:4000/users/login', [
                        'form_params' => ['username'=>$userID,'orgName' =>'excise']
                        ]);
        if($login->getStatusCode() != 200){
            return false;
        }    
        $m = $login->getBody(); 
        $m2 = json_decode($m);
        if($m2->success != 1){
            return false;
        }
        $token = $m2->message->token;
        $data = [
            'username'  =>  $userID,
            'orgName'   =>  'excise',
            'fcn'       =>  'ReceiveFromDealer',
            'chaincodeName' => 'vrschaincode',
            'channelName' => 'vrschannel',
            'args'        =>  [$assetID]
        ];
        
        $response = $guzzle->request('POST', 'http://localhost:4000/channels/vrschannel/chaincodes/vrschaincode', [
            'headers'   => [
                'Accept'=>'application/json',
                'Content-Type'=>'application/json',
                'Authorization'=> 'Bearer '.$token
            ],
            'body'      => json_encode($data),
        ]);
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody());
            if(isset($result->result->status) && $result->result->status == "404"){
                return false;
            }
            return true;
        }
        
        return false;
    }

    private function ChangeOwner($assetID,$userID,$newOwnerID,$newOwnerName,$registrationDate,$registrationNumber){
        
        // $data = [
        //     'assetID'=>$assetID,
        //     'userID'=>$userID,
        //     "newOwnerID"=>$newOwnerID,
        //     'newOwnerName'=>$newOwnerName,
        //     'registraionDate'=>$registrationDate,
        //     'registrationNumber'=>$registrationNumber
        // ];
        // dd($data);
        // dd();
        $guzzle = new \GuzzleHttp\Client;
        $login = $guzzle->request('POST', 'http://localhost:4000/users/login', [
                        'form_params' => ['username'=>$userID,'orgName' =>'excise']
                        ]);
        if($login->getStatusCode() != 200){
            return false;
        }    
        $m = $login->getBody(); 
        $m2 = json_decode($m);
        if($m2->success != 1){
            return false;
        }
        $token = $m2->message->token;
        $data = [
            'username'  =>  $userID,
            'orgName'   =>  'excise',
            'fcn'       =>  'ChangeOwner',
            'chaincodeName' => 'vrschaincode',
            'channelName' => 'vrschannel',
            'args'        =>  [$assetID,$newOwnerID,$newOwnerName,$registrationDate,$registrationNumber]
        ];
        
        $response = $guzzle->request('POST', 'http://localhost:4000/channels/vrschannel/chaincodes/vrschaincode', [
            'headers'   => [
                'Accept'=>'application/json',
                'Content-Type'=>'application/json',
                'Authorization'=> 'Bearer '.$token
            ],
            'body'      => json_encode($data),
        ]);
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody());
            if(isset($result->result->status) && $result->result->status == "404"){
                return false;
            }
            return true;
        }
        
        return false;
    }

}
