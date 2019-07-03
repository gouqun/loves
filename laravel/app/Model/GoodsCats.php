<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsCats extends Model
{
    protected $table ='shop_goods_cats';
    protected $primaryKey = 'catId';
    public $timestamps = false;

    public function CatsSel()
    {
        $arr = $this->get()->toarray();
        $data = $this->Selparent($arr,0);
        dd($data);
    }

    public function Selparent($arr ,$p)
    {
        $parent =[];
        foreach ($arr as $key =>$val)
        {
            if($p == $val['parentId']) {
                $parent[$key]['catName'] = $val['catName'];
                $parent[$key]['dataFlag'] = $val['dataFlag'];
                $parent[$key]['child'] = $this->Selparent($arr, $val['catId']);
            }
        }
        return $parent;
    }
}
