<?php
namespace App\model;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserInf extends Authenticatable
{
    protected $table="user_inf";
    protected $primaryKey = 'user_inf_id';
    public $timestamps = false;
    protected $fillable = ['mobile_phone', 'login_name','password'];

}