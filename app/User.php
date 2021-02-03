<?php

namespace App;

use App\User_role_join;
use App\Manufacturer_profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    use softDeletes;

    protected $guard = [];
    

    public function scopeEmail($query,$email){
        return $query->where('email', $email);
    }
    public function role(){
        return $this->hasMany(User_role_join::class); 
    } 
    public function manufacturer_profile($columnName = null){
        if( $columnName != null){
            return $this->hasOne(Manufacturer_profile::class)->select($columnName);
        }
        return $this->hasOne(Manufacturer_profile::class);
        
    } 



}
