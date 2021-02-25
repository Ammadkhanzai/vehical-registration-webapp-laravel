<?php

namespace App\Http\Controllers;

use App\Vehical;
use Illuminate\Http\Request;
use App\Vehical_manufacturer_join;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class VehicalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $user = Auth::user();
        $userModel = $user->manufacturer_profile(['id','user_id'])->first();
        $vehicals = Vehical_manufacturer_join::with('vehical')
                                                ->where('manufacturer_profile_id',$userModel->id)
                                                ->orderBy('created_at')
                                                ->has('vehical')
                                                ->get();
        // dd($vehicals);                                                
        return view('manufacturer.vehical')->with('vehicals',$vehicals);
        // return view('manufacturer.vehical',compact("Vehicals"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('manufacturer.add-new-vehical');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        // dd($request->all());
        $validator = Validator::make($request->all(), 
            [
                'model' => ['required','string','max:255'],
                'color'=> ['required','string','max:255'],
                'maker'=> ['required','string','max:255'],
                'engine_number'=> ['required','string','max:255','unique:vehicals'],
                'chassis_number'=> ['required','string','max:255'],
                'engine_capacity'=> ['required','string','max:255'],
                'class'=> ['required','string','max:255'],
                'transmission'=> ['required','string','max:255'],
                'interior_features'=> ['nullable','string','max:500'],
                'exterior_features'=> ['nullable','string','max:500'],
                'fuel_type'=> ['required','string','max:255'],
                'safety'=> ['nullable','string','max:255'],
                'seating_capacity'=> ['required','string','max:255'],
            ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = Auth::user();
        $userModel = $user->manufacturer_profile(['id','user_id','company_registration_no','company_name'])->first();

        $vehical = new Vehical();
        $vehical->model = $request->model;
        $vehical->color = $request->color;
        $vehical->maker = $request->maker;
        $vehical->engine_number = $request->engine_number;
        $vehical->chassis_number = $request->chassis_number;
        $vehical->engine_capacity = $request->engine_capacity;
        $vehical->vehical_class = $request->class;
        $vehical->transmission = $request->transmission;
        $vehical->interior_features = $request->interior_features;
        $vehical->exterior_features = $request->exterior_features;
        $vehical->fuel_type = $request->fuel_type;
        $vehical->safety = $request->safety;
        $vehical->seating_capacity = $request->seating_capacity;
        $vehical->state = "fresh";
        $vehical->status = "under_manufacturer";
        $save = $vehical->save();
        if($save){
            $response = $this->CreateVehical(md5($vehical->id), $request->engine_number,$request->chassis_number,time(), $userModel->company_name,$userModel->company_registration_no);
            
            if($response){
                $vehcalManufacturerJoin = new Vehical_manufacturer_join();
                $vehcalManufacturerJoin->vehical_id = $vehical->id;
                $vehcalManufacturerJoin->manufacturer_profile_id = $userModel->id;
                $save = $vehcalManufacturerJoin->save();
                if($save){
                    return back()->with('status', 'Vehical successfully created.');
                }
            }else{
                $vehical->delete();
            }
        }
        
        return back()->withErrors(['Vehical creation failed.']);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehical  $vehical
     * @return \Illuminate\Http\Response
     */
    public function show(Vehical $vehical)
    {
        return view('manufacturer.show-vehical')->with('vehical',$vehical);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehical  $vehical
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehical $vehical)
    {
        return view('manufacturer.edit-vehical')->with('vehical',$vehical);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vehical  $vehical
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehical $vehical){
        $validator = Validator::make($request->all(), 
            [
                'model' => ['required','string','max:255'],
                'color'=> ['required','string','max:255'],
                'maker'=> ['required','string','max:255'],
                'engine_number'=> ['required','string','max:255'],
                'chassis_number'=> ['required','string','max:255'],
                'engine_capacity'=> ['required','string','max:255'],
                'class'=> ['required','string','max:255'],
                'transmission'=> ['required','string','max:255'],
                'interior_features'=> ['nullable','string','max:500'],
                'exterior_features'=> ['nullable','string','max:500'],
                'fuel_type'=> ['required','string','max:255'],
                'safety'=> ['nullable','string','max:255'],
                'seating_capacity'=> ['required','string','max:255'],
            ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $newVehical = new Vehical();

        $newVehical->model = $request->model;
        $newVehical->color = $request->color;
        $newVehical->maker = $request->maker;
        $newVehical->engine_number = $request->engine_number;
        $newVehical->chassis_number = $request->chassis_number;
        $newVehical->engine_capacity = $request->engine_capacity;
        $newVehical->vehical_class = $request->class;
        $newVehical->transmission = $request->transmission;
        $newVehical->interior_features = $request->interior_features;
        $newVehical->exterior_features = $request->exterior_features;
        $newVehical->fuel_type = $request->fuel_type;
        $newVehical->safety = $request->safety;
        $newVehical->seating_capacity = $request->seating_capacity;
        $vehical->forceDelete();
        $save = $newVehical->save();
        if($save){
            
            
            $user = Auth::user();
            $userModel = $user->manufacturer_profile(['id','user_id','company_registration_no','company_name'])->first();

            $vehcalManufacturerJoin = new Vehical_manufacturer_join();
            $vehcalManufacturerJoin->vehical_id = $newVehical->id;
            $vehcalManufacturerJoin->manufacturer_profile_id = $userModel->id;
            $save = $vehcalManufacturerJoin->save();


            $result = $this->UpdateVehical(md5($newVehical->id), $request->engine_number,$request->chassis_number,time(), $userModel->company_name,$userModel->company_registration_no);
            return redirect()->route('manufacturer.admin.view.vehicals')->with('status', 'Vehical updated successfully.');
            // return back()->with('status', 'Vehical updated successfully.');
        }else{
            return back()->withErrors(['something went wrong in code.']);   
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehical  $vehical
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehical $vehical)
    {
        $vehical->delete();
        return back()->with('status', 'Vehical deleted successfully.');
    }

    private function CreateVehical($assetID, $engineNumber,$chassisNumber, $manufactureDate, $manufacturerName, $manufacturerID){
        
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
            'fcn'       =>  'CreateVehical',
            'chaincodeName' => 'vrschaincode',
            'channelName' => 'vrschannel',
            'args'        =>  [$assetID,$engineNumber,$chassisNumber,$manufactureDate,$manufacturerName,$manufacturerID]
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

    private function UpdateVehical($assetID, $engineNumber,$chassisNumber, $manufactureDate, $manufacturerName, $manufacturerID){
        
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
        $dataPre = [
            'username'  =>  $manufacturerID,
            'orgName'   =>  'manufacturer',
            'fcn'       =>  'DeleteVehical',
            'chaincodeName' => 'vrschaincode',
            'channelName' => 'vrschannel',
            'args'        =>  [$assetID]
        ];
        $responseDelete = $guzzle->request('POST', 'http://localhost:4000/channels/vrschannel/chaincodes/vrschaincode', [
            'headers'   => [
                'Accept'=>'application/json',
                'Content-Type'=>'application/json',
                'Authorization'=> 'Bearer '.$token
            ],
            'body'      => json_encode($dataPre),
        ]);
        $data = [
            'username'  =>  $manufacturerID,
            'orgName'   =>  'manufacturer',
            'fcn'       =>  'CreateVehical',
            'chaincodeName' => 'vrschaincode',
            'channelName' => 'vrschannel',
            'args'        =>  [$assetID,$engineNumber,$chassisNumber,$manufactureDate,$manufacturerName,$manufacturerID]
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
