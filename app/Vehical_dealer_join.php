<?php

namespace App;

use App\Vehical;
use App\Dealer_profile;
use App\Vehical_user_join;
use App\Vehical_dealer_join;
use App\Vehical_manufacturer_join;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Vehical_dealer_join extends Model
{

    public function joinWithManufacturer(){
        $user = Auth::user();
        $userModel = $user->manufacturer_profile(['id','user_id'])->first();
        return $this->belongsTo(Vehical_manufacturer_join::class,'vehical_id','vehical_id')->where([
            'manufacturer_profile_id'=>$userModel->id,
        ]); 
    }

    public function vehical_user_join(){
        $user = new User_profile();
        $profile = $user->where('user_id',Auth::id())->first();
        return $this->belongsTo(Vehical_user_join::class,'vehical_id','vehical_id')->where([
            'user_profile_id'=>$profile->id,
            'receive'=>'false'
        ]); 
    }



    public function fetchDealer(){
        return $this->belongsTo(Dealer_profile::class,'dealer_profile_id'); 
    }
    public function fetchVehical(){
        return $this->belongsTo(Vehical::class,'vehical_id'); 
    }

    public function joinWithDealers(){
        
        return $this->belongsTo(Vehical::class,'vehical_id','id')->where('state','sold'); 
    }
    public function checkbeforetransfer(){
        return $this->belongsTo(Vehical::class,'vehical_id','id')->where('status','under_dealer'); 
    }

}
