<?php

namespace App;


use App\Vehical;
use App\Vehical_dealer_join;
use App\Manufacturer_profile;
use Illuminate\Database\Eloquent\Model;

class Vehical_manufacturer_join extends Model
{
    protected $guard = [];
    //

    

    public function vehical(){
        return $this->belongsTo(Vehical::class)->where(['status'=>'under_manufacturer','state'=>'fresh']); 
    }

    public function getSoldVehicals(){
        return $this->belongsTo(Vehical::class,'vehical_id')->where(['status'=>'under_dealer']); 
    }

    public function getDealerID(){
        return $this->belongsTo(Vehical_dealer_join::class,'vehical_id','vehical_id'); 
    }
    
    
    
    
    

}
