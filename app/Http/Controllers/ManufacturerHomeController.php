<?php

namespace App\Http\Controllers;

use App\Dealer_profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManufacturerHomeController extends Controller
{
    //
    public function index(){
        $user = Auth::user();
        $userModel = $user->manufacturer_profile()->first();
        
        // dd($userModel);
        return view('manufacturer.dashboard')->with('userModel',$userModel);
    }


    public function showDealer()
    {
        $dealer = new Dealer_profile();
        $dealers = $dealer->all()->where('is_active','true');
        return view('manufacturer.dealer')->with('dealers',$dealers);
    }
}
