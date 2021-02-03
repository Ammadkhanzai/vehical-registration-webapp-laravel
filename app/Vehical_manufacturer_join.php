<?php

namespace App;


use App\Vehical;
use App\Manufacturer_profile;
use Illuminate\Database\Eloquent\Model;

class Vehical_manufacturer_join extends Model
{
    protected $guard = [];
    //



    public function vehical(){
        return $this->belongsTo(Vehical::class)->where(['status'=>'under_manufacturer','state'=>'fresh']); 
    }

    
    

}
