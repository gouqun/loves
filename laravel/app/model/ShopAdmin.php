<?php

namespace App\model;

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
//    protected $fillable = ['mobile_phone', 'login_name', 'password'];

}