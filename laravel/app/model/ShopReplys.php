<?php

namespace App\Model;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
class ShopReplys extends Authenticatable
{
    protected $table = "shop_replys";
    protected $primaryKey = 'id';
    public $timestamps = false;
//    protected $fillable = ['mobile_phone', 'login_name', 'password'];
    protected $hidden = ['admin_id','id'];
    public function one()
    {
        return $this->hasOne('App\Model\ShopAdmin','id','admin_id');
    }
    public function index(Request $request)
    {
        return $this::with(['one'=>function($quest){
            $quest->select('admin_name','id');
        }])->where('p_id',$request->get('user')['user_id'])->get();
    }
}