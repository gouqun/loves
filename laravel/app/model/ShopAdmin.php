<?php

namespace App\Model;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;

class ShopAdmin extends Authenticatable
{
    protected $table = "shop_admin";
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $hidden = ['id'];
//  ssprotected $fillable = ['mobile_phone', 'login_name', 'password'];

}