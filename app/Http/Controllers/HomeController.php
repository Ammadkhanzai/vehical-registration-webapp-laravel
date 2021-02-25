<?php

namespace App\Http\Controllers;

use Throwable;
use App\Vehical;
use App\Dealer_profile;
use Illuminate\Http\Request;
use App\Manufacturer_profile;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('front-page');
    }

    public function search(Request $request){
        $request->validate([
            'engineNumber'=> 'required|string|max:20',
            'numberPlate'=> 'required|string|max:20',
        ]);
        $input = $request->only(['engineNumber', 'numberPlate']);
        // dd($input['engineNumber']);
        $vehicalModel = new Vehical();
        $vehical = $vehicalModel->with('vehical_manufacturer_join')
                                ->with('vehical_dealer_join')
                                ->where(['engine_number'=>$input['engineNumber'],'status'=>'UNDER_USER'])
                                ->has('vehical_manufacturer_join')
                                ->has('vehical_dealer_join')
                                ->firstorFail();

        $manufacturerModel = new Manufacturer_profile();        
        $manufacture = $manufacturerModel->where('id',$vehical->vehical_manufacturer_join->manufacturer_profile_id )
                                         ->firstorFail();

        $dealerModel = new Dealer_profile();
        $dealer = $dealerModel->where('id',$vehical->vehical_dealer_join->dealer_profile_id )
                                         ->firstorFail();                        

        
        // dd($vehical);
        $result  = $this->GetAssetHistory($input['numberPlate'],$input['engineNumber']);
        
        if($result['status'] == '201'){
            
            return view('lifetime')->with([
                                        'history'=>$result['history'],
                                        'record'=>$result['record'],
                                        'vehical'=>$vehical,
                                        'manufacturer'=>$manufacture,
                                        'dealer'=>$dealer,
                                        ]);
            
        }elseif($result['status'] == '404'){
            dd($result);    
        }
        

        
        
    }

    

    private function GetAssetHistory($numberplate){
        
        $guzzle = new \GuzzleHttp\Client;
        $login = $guzzle->request('POST', 'http://localhost:4000/users/login', [
                        'form_params' => ['username'=>'admin','orgName' =>'excise']
                        ]);
        if($login->getStatusCode() != 200){
            return false;
        }    
        $m = $login->getBody(); 
        $m2 = json_decode($m);
        if($m2->success != 1){
            return false;
        }
        // "assetID"=>"6c8349cc7260ae62e3b1396831a8398f",
        
        $token = $m2->message->token;
        $string = json_encode(["selector"=>["state"=>"UNDER_CUSTOMER","numberplate"=>$numberplate]]);
        
        $QueryAsset=[
            'username'  =>  'admin',
            'orgName'   =>  'excise',
            'fcn'       =>  'GetQueryResultForQueryString',
            'chaincodeName' => 'vrschaincode',
            'channelName' => 'vrschannel',
            'args'        =>  [$string]                
        ];
        $response = $guzzle->request('POST', 'http://localhost:4000/channels/vrschannel/chaincodes/vrschaincode', [
            'headers'   => [
                'Accept'=>'application/json',
                'Content-Type'=>'application/json',
                'Authorization'=> 'Bearer '.$token
            ],
            'body'      => json_encode($QueryAsset),
        ]);
        
        if($response->getStatusCode() == 200){
            $result = json_decode($response->getBody());
            if($result != null){
                // print_r($result[0]->Record->assetID);
                
                $assetID = $result[0]->Record->assetID;
                $singleRecord = $result[0]->Record;
                
            }else{
                
                return $response = [
                    'status'=>'404',
                    'message' => 'Result Not Found.'
                ];
            }  
        }

        

        $AssetHistory = [
            'username'  =>  'admin',
            'orgName'   =>  'excise',
            'fcn'       =>  'GetAssetHistory',
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
            'body'      => json_encode($AssetHistory),
        ]);
        // echo $response->getStatusCode()."<br>";
        // echo $response->getHeader('content-type')[0]."<br>";
        // echo "<pre>";
        // print_r($result);
        // dd(json_decode($response->getBody()))."<br>"; 
        // dd($response);
        
        return $response = [
            'status'=>'201',
            'message'=>'Record Found.',
            'history'=>json_decode($response->getBody()),
            'record'=>$singleRecord,
        ];
        
    }
}
