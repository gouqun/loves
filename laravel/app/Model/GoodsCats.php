<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsCats extends Model
{
    protected $table ='shop_goods_cats';
    protected $primaryKey = 'catId';
    public $timestamps = false;

    public function CatsSel($catId)
    {
        return $this->where('parentId',$catId)->get()->toarray();

    }
}
