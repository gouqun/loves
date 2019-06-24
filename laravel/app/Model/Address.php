<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table ='shop_user_address';
    public $timestamps = false;
    protected $primaryKey = 'user_id';
    public static function AddressSel($user_id)
    {

        return Address::find($user_id);
    }
}
