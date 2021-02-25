<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manufacturer_profile;
use App\Vehical_manufacturer_join;
use Illuminate\Support\Facades\Auth;

class ManufacturerProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $user = Auth::user();
        // $userModel = $user->manufacturer_profile(['id'])->first();
        // return view('manufacturer.dashboard')->with('ID',$userModel->id);
        
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Manufacturer_profile  $manufacturer_profile
     * @return \Illuminate\Http\Response
     */
    public function show(Manufacturer_profile $manufacturer_profile)
    {
        //

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Manufacturer_profile  $manufacturer_profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Manufacturer_profile $manufacturer_profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Manufacturer_profile  $manufacturer_profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Manufacturer_profile $manufacturer_profile)
    {

        $user = Auth::user();
        $manufacturer_profile = $user->manufacturer_profile()->first();
        

        $request->validate([
            'name'=> ['required','string','max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'website' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ]);

        $manufacturer_profile->company_name = $request->name;
        $manufacturer_profile->company_phone = $request->phone;
        $manufacturer_profile->company_email = $request->email;
        $manufacturer_profile->company_address = $request->address;
        $manufacturer_profile->company_website = $request->website;
        $manufacturer_profile->approval = "true";
        if($manufacturer_profile->is_active == "true"){
            return back()->withErrors(['Not eligible to update Profile.']); 
        }
        $save = $manufacturer_profile->save();
        if($save){
            return back()->with('status', 'Profile Updated successfully created.');
        }
        return back()->withErrors(['something went wrong in code.']); 
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Manufacturer_profile  $manufacturer_profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Manufacturer_profile $manufacturer_profile)
    {
        //
    }
}
