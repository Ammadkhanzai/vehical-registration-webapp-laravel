<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class User_role_join extends Model
{
    //
    protected $guard = [];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
