<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_profile extends Model
{
    //
    use SoftDeletes;

    public function getusers(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function fetchforadmin(){
        return $this->hasOne(User::class,'id','user_id'); 
    }

}
