<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Roles;
use App\Address;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */  
    protected $fillable = [
        'role_id','full_name', 'email', 'username', 'password', 'phone_no', 'profile_img',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo(Roles::class);
    }

    public function addresses(){
        return $this->hasMany(Address::class, 'user_id');
    }

}
