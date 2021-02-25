<?php

namespace App\Http\Controllers;

use App\Vehical;
use App\Dealer_profile;
use App\Vehical_dealer_join;
use App\Vehical_manufacturer_join;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Redirect,Response;


class TransferToDealerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if ($request->has('id')) {
            $request->validate([
                'id' => 'required|numeric',
            ]);
                
            $user = Auth::user();
            $userModel = $user->manufacturer_profile(['id','user_id'])->first();
            $vehicals = Vehical_manufacturer_join::with('vehical')
                                                ->where('manufacturer_profile_id',$userModel->id)
                                                ->orderBy('created_at')
                                                ->has('vehical')
                                                ->get();
            return view('manufacturer.transfer-vehical')->with(['dealerID'=>$request->input('id'),'vehicals'=>$vehicals]);
         }else{
             return abort('404');
         }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $vehicals = Vehical_dealer_join::with('joinWithManufacturer')
                                        ->with('fetchDealer')
                                        ->with('fetchVehical')
                                        ->orderBy('created_at','desc')
                                        ->has('joinWithManufacturer')
                                        ->has('fetchDealer')
                                        ->has('fetchVehical')
                                        ->get();
        // dd($vehicals);
        return view('manufacturer.transfered-vehical')->with('vehicals',$vehicals);  
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        
        if($request->ajax()){   

            $request->validate([
                'vehicalID' => 'required|numeric',
                'dealerID' => 'required|numeric',
            ]);
            $dealerModel = Dealer_profile::where('is_active','true')->findOrFail($request->input('dealerID'));
            
            $user = Auth::user();
            $userModel = $user->manufacturer_profile(['id','user_id','company_registration_no','company_name'])->first();
            $vehicals = Vehical_manufacturer_join::with('vehical')
                                                    ->where('manufacturer_profile_id',$userModel->id)
                                                    ->where('vehical_id',$request->vehicalID)
                                                    ->orderBy('created_at')
                                                    ->has('vehical')
                                                    ->exists();
            
            if($vehicals){
                $response = $this->TransferVehical(md5($request->input('vehicalID')),$dealerModel->business_registration_no,$userModel->company_registration_no);
                

                if($response != true){
                    return Response::json(['status' => 'false', 'message' => 'vehical not found','response'=>$response]);
                }
                $dealerJoin = new Vehical_dealer_join();
                $dealerJoin->vehical_id = $request->input('vehicalID');
                $dealerJoin->dealer_profile_id = $request->input('dealerID');
                $dealerJoin->receive = "false";
                $save = $dealerJoin->save();
                if($save){
                  $vehicalObj = Vehical::find($request->input('vehicalID')); 
                  $vehicalObj->state = 'sold';
                  $vehicalObj->status = 'under_dealer';
                  $vehicalObj->save();
                }
                return Response::json(['status' => 'true', 'transfered' => $response ]);
                // return Response::json(['status' => 'true', 'transfered' => 'successfull']);
            }
            return Response::json(['status' => 'false', 'message' => 'vehical not found']);
        }
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dealer = Dealer_profile::where('is_active','true')->findOrFail($id);
        return view('manufacturer.show-dealer')->with('dealer',$dealer);   
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        echo "edit";
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function TransferVehical($assetID,$dealerID,$manufacturerID){
        
        $guzzle = new \GuzzleHttp\Client;
        $login = $guzzle->request('POST', 'http://localhost:4000/users/login', [
                        'form_params' => ['username'=>$manufacturerID,'orgName' =>'manufacturer']
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
            'username'  =>  $manufacturerID,
            'orgName'   =>  'manufacturer',
            'fcn'       =>  'TransferToDealer',
            'chaincodeName' => 'vrschaincode',
            'channelName' => 'vrschannel',
            'args'        =>  [$assetID,$dealerID]
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
