<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dealer_profile extends Model
{
    use SoftDeletes;
    //
    public function user(){
        return $this->hasOne(User::class); 
    }
    public function fetchforadmin(){
        return $this->hasOne(User::class,'id','user_id'); 
    }
}
