<?php

namespace App;

use App\Vehical;
use App\User_profile;
use App\Vehical_dealer_join;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Vehical_user_join extends Model
{
    //

    public function fetchUser(){
        return $this->belongsTo(User_profile::class,'user_profile_id'); 
    }
    public function fetchVehical(){
        return $this->belongsTo(Vehical::class,'vehical_id'); 
    }

    public function getDealerID(){
        return $this->belongsTo(Vehical_dealer_join::class,'vehical_id','vehical_id'); 
    }
    

    public function joinWithDealer(){
        $user = Auth::user();
        $userModel = $user->dealer_profile(['id','user_id'])->first();
        return $this->belongsTo(Vehical_dealer_join::class,'vehical_id','vehical_id')->where([
            'dealer_profile_id'=>$userModel->id,
        ]); 
    }

    public function withLastOwner(){
        return $this->belongsTo(User_profile::class,'last_owner','id'); 
    }
    
}
