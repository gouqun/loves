<?php

namespace App\model;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    protected $table="user_login";
    protected $primaryKey = 'user_id';
    public $timestamps = false;
   protected $fillable = ['mobile_phone', 'customer_email','login_name','password'];
    // protected $guard = [];
//    protected $hidden = ['password', 'remember_token'];
    public function login($request)
    {
        return $this->where($request)->first();
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function UserInf()
    {
        return $this->hasOne('App\model\UserInf','user_id','user_id');
    }
}