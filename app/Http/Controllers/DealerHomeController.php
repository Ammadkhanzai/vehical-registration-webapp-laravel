<?php

namespace App\Http\Controllers;

use App\User;
use Response;
use App\Vehical;
use App\User_profile;
use App\Dealer_profile;
use App\Vehical_user_join;
use App\Vehical_dealer_join;
use Illuminate\Http\Request;
use App\Manufacturer_profile;
use Illuminate\Support\Facades\Auth;

class DealerHomeController extends Controller
{
    //
    public function index(){
        $user = new Dealer_profile();
        $profile = $user->where('user_id',Auth::id())->first();
        return view('dealer.dashboard')->with('userModel',$profile);
        
    }

    public function showManufacturers(){
        
        $manufacturer = new Manufacturer_profile();
        $manufacturers = $manufacturer->all()->where('is_active','true');
        // dd($manufacturers);
        return view('dealer.manufacturer')->with('manufacturers',$manufacturers);
    }

    public function receiveVehicals(){
        $user = new Dealer_profile();
        $profile = $user->where('user_id',Auth::id())->first();
        // $vehicals = Vehical_dealer_join::with('joinWithDealers')
        //                                         ->where('dealer_profile_id',$profile->id)
        //                                         ->where('receive','false')
        //                                         ->orderBy('created_at')
        //                                         ->get();
        $vehicals = Vehical_dealer_join::where('dealer_profile_id',$profile->id)
                                                ->where('receive','false')
                                                ->orderBy('created_at')
                                                ->get();
        // dd($vehicals);
        return view('dealer.receive-new-vehical')->with('vehicals',$vehicals);
        
    }

    public function receiveVehical(Request $request){
        $user = new Dealer_profile();
        $profile = $user->where('user_id',Auth::id())->first();
        $vehical = Vehical_dealer_join::where('dealer_profile_id',$profile->id)
                                                ->where('receive','false')
                                                ->where('id',$request->input('id'))
                                                ->firstorFail();
        
        $response = $this->ReceiveFromManufacturer(md5($vehical->vehical_id), $profile->business_registration_no);                               
        if($response){
            $vehical->receive = 'true';
            $save = $vehical->save();
            if($save){
                return back()->with('status', 'Vehical successfully received.');
            }
        }
        return back()->withErrors(['something went wrong.']);
    }

    public function vehicals(){
        $user = new Dealer_profile();
        $profile = $user->where('user_id',Auth::id())->first();
        $vehicals = Vehical_dealer_join::with('checkbeforetransfer')
                                                ->where('dealer_profile_id',$profile->id)
                                                ->where('receive','true')
                                                ->has('checkbeforetransfer')
                                                ->orderBy('created_at')
                                                ->get();
        return view('dealer.vehical')->with('vehicals',$vehicals);
    }
    public function showVehical($id){
        // return view('manufacturer.show-vehical')->with('vehical',$vehical); 
        // dd(Vehical::findOrFail($id));
        $user = new Dealer_profile();
        $profile = $user->where('user_id',Auth::id())->first();
        $vehical = Vehical_dealer_join::with('joinWithDealers')
                                                ->where('dealer_profile_id',$profile->id)
                                                ->where('receive','true')
                                                ->where('id',$id)
                                                ->orderBy('created_at')
                                                ->first();
                                                
        // dd($vehical);                                                
        if($vehical){
            return view('dealer.show-vehical')->with('vehical',$vehical);
        }                                                
        abort(404);  
    }


    public function transferVehicals(){
        //    $userProfile = new User_profile();
          $userProfile = User_profile::with('getusers')
                                        ->where('is_active','true')  
                                        ->get();
        // dd($userProfile);             
        return view('dealer.transfer-to-client')->with('userProfile',$userProfile);
    }
    public function transferVehicalSecond($id){
        
        if ($id != null && !empty($id) && is_numeric($id)) {
            User_profile::where('id',$id)->where('is_active','true')->firstOrFail();
            $user = new Dealer_profile();
            $profile = $user->where('user_id',Auth::id())->first();
            $vehicals = Vehical_dealer_join::with('checkbeforetransfer')
                                                    ->where('dealer_profile_id',$profile->id)
                                                    ->where('receive','true')
                                                    ->orderBy('created_at')
                                                    ->has('checkbeforetransfer')
                                                    ->get();
            // dd($vehicals);                                                    
            return view('dealer.transfer-vehical')->with(['clientID'=>$id,'vehicals'=>$vehicals]);
         }else{
             return abort('404');
         }
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
    public function getNumberPlate($length = 6) {
        $validCharacters = "ABCDEFGHIJKLMNOPQRSTUXYVWZ";
        $validNumbers = "1234567890";
        $validCharNumber = strlen($validCharacters);
     
        $result = "";
     
        for ($i = 0; $i < 4 ; $i++) {
            $index = mt_rand(0, $validCharNumber - 1);
            $result .= $validCharacters[$index];
        }
        $result.= '-';
        for ($i = 0; $i < 3; $i++) {
            $index = mt_rand(0, strlen($validNumbers) - 1);
            $result .= $validNumbers[$index];
        }
     
        return $result;
    }
    public function transferVehicalSubmit(Request $request){

        if($request->ajax()){   

            $request->validate([
                'vehicalID' => 'required|numeric',
                'clientID' => 'required|numeric',
            ]);
            $clientProfile = User_profile::where('is_active','true')->findOrFail($request->input('clientID'));
            $user = new Dealer_profile();
            $profile = $user->where('user_id',Auth::id())->first();
            $vehicals = Vehical_dealer_join::with('checkbeforetransfer')
                                                    ->where('dealer_profile_id',$profile->id)
                                                    ->where('id',$request->input('vehicalID'))
                                                    ->where('receive','true')
                                                    ->has('checkbeforetransfer')
                                                    ->firstorFail();
            $registraion_no = 'VEHICAL_'.$this->uniqidReal();
            $numberPlate =  $this->getNumberPlate();
            
            $response = $this->TransferToOwner(md5($vehicals->checkbeforetransfer->id),$profile->business_registration_no,$clientProfile->user_registration_no, $clientProfile->first_name.' '.$clientProfile->last_name ,time(),$registraion_no, $numberPlate);

            if($response){
                $userJoin = new Vehical_user_join();
                $userJoin->vehical_id = $vehicals->checkbeforetransfer->id;
                $userJoin->user_profile_id = $request->input('clientID');
                $userJoin->receive = "false";
                $save = $userJoin->save();
                if($save){
                  $vehicalObj = Vehical::find($vehicals->checkbeforetransfer->id); 
                  $vehicalObj->state = 'sold';
                  $vehicalObj->status = 'under_user';
                  $vehicalObj->save();
                }
                return Response::json(['status' => 'true', 'transfered' => 'successfull']);
            }
            
        }
        abort(404);
    }

    public function transferedVehicals(){

        $vehicals = Vehical_user_join::with('joinWithDealer')
                                        ->with('fetchUser')
                                        ->with('fetchVehical')
                                        ->orderBy('created_at','desc')
                                        ->has('joinWithDealer')
                                        ->has('fetchUser')
                                        ->has('fetchVehical')
                                        ->get();
        // dd($vehicals);
        return view('dealer.transfered-vehical')->with('vehicals',$vehicals);
    }


    public function clients(){
        $users = new User_profile();
        $clients = $users->all()->where('is_active','true');

        return view('dealer.clients')->with('clients',$clients);
    }
    public function client($id){
       $user = User_profile::where('is_active','true')
                            ->where('id',$id)    
                            ->firstOrFail();
        return view('dealer.show-client')->with('user',$user);
       
    }


    public function updateProfile(Request $request){
        
        $user = new Dealer_profile();
        $profile = $user->where('user_id',Auth::id())->first();
        
        $request->validate([
            'name'=> ['required','string','max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'website' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        $profile->business_name = $request->name;
        $profile->business_phone = $request->phone;
        $profile->business_email = $request->email;
        $profile->business_website = $request->website;
        $profile->business_address = $request->address;
        $profile->approval = 'true';
        if($profile->is_active == "true"){
            return back()->withErrors(['Not eligible to update Profile.']); 
        }
        $save = $profile->save();
        if($save){
            return back()->with('status', 'Profile Updated successfully created.');
        }
        return back()->withErrors(['something went wrong in code.']); 
        
        
    }



    private function ReceiveFromManufacturer($assetID,$dealerID){
        
        $guzzle = new \GuzzleHttp\Client;
        $login = $guzzle->request('POST', 'http://localhost:4000/users/login', [
                        'form_params' => ['username'=>$dealerID,'orgName' =>'dealer']
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
        // echo $login->getBody();
        // dd($login);
        $data = [
            'username'  =>  $dealerID,
            'orgName'   =>  'manufacturer',
            'fcn'       =>  'ReceiveFromManufacturer',
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

    private function TransferToOwner($assetID,$dealerID ,$ownerID, $ownerName,$registrationDate,$registrationNumber,$numberplate){

        // $data = [
        //     'assetID'=>$assetID,
        //     'dealerID' =>$dealerID,
        //     'ownerID'=>$ownerID,
        //     'ownerName'=>$ownerName,
        //     'registrationDate'=>$registrationDate,
        //     'registrationNumber'=>$registrationNumber,
        //     'numberPlate'=>$numberplate,
        // ];
        
        $guzzle = new \GuzzleHttp\Client;
        $login = $guzzle->request('POST', 'http://localhost:4000/users/login', [
                        'form_params' => ['username'=>$dealerID,'orgName' =>'dealer']
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
            'username'  =>  $dealerID,
            'orgName'   =>  'dealer',
            'fcn'       =>  'TransferToOwner',
            'chaincodeName' => 'vrschaincode',
            'channelName' => 'vrschannel',
            'args'        =>  [$assetID, $ownerID, $ownerName,$registrationDate,$registrationNumber,$numberplate]
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
