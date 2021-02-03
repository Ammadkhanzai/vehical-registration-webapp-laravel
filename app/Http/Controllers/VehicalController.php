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
    
        // $a = new Vehical_manufacturer_join();
        // $dd = $a->with('vehical')->where('manufacturer_profile_id',$userModel->id)->has('vehical')->get();
        
        // echo "<pre>";
        // foreach($dd as $join){
        //     // echo $join->created_at;
        //     // echo "<br>";
        //     print_r($join->vehical);
        //     echo "<br><br><br><br><br>";
        //     echo "-------------------";
        //     echo "<br><br><br><br><br>";
        // }
        
        $vehicals = Vehical_manufacturer_join::with('vehical')
                                                ->where('manufacturer_profile_id',$userModel->id)
                                                ->orderBy('created_at')
                                                ->has('vehical')
                                                ->get();
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
        $userModel = $user->manufacturer_profile(['id','user_id'])->first();

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
            $vehcalManufacturerJoin = new Vehical_manufacturer_join();
            $vehcalManufacturerJoin->vehical_id = $vehical->id;
            $vehcalManufacturerJoin->manufacturer_profile_id = $userModel->id;
            $save = $vehcalManufacturerJoin->save();
            if($save){
                return back()->with('status', 'Vehical successfully created.');
            }

        }
        return back()->withErrors(['something went wrong in code.']);
        
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
        $save = $vehical->save();
        if($save){
            return back()->with('status', 'Vehical updated successfully.');
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

}
