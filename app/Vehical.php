<?php

namespace App;

use App\Vehical_manufacturer_join;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehical extends Model
{
    use SoftDeletes;
    public function scopeGetUnsoldVehicals($query){
        return $query->where('state', '=', 'fresh')->where('status', '=', 'under_manufacturer');
    }
    public function vehical_manufacturer_join(){
        return $this->hasOne(Vehical_manufacturer_join::class); 
    }
    public function vehical_dealer_join(){
        return $this->hasOne(Vehical_dealer_join::class); 
    }
    

}
