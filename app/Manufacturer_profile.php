<?php

namespace App;

use App\User;
use App\Vehical_manufacturer_join;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Manufacturer_profile extends Model
{
    //
    use SoftDeletes;
    
    public function user(){
        return $this->hasOne(User::class); 
    }
    
    public function Vehical_manufacturer_join(){
        return $this->hasMany(Vehical_manufacturer_join::class); 
    }
}
