<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsSpecs extends Model
{
    protected $table ='shop_goods_specs';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded =[];
    public function goodsspecs()
    {

    }
    public function CollectAdd($post)
    {

    }
}
