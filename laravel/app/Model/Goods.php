<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    protected $table ='shop_good';
    protected $primaryKey = 'goodsId';
    public $timestamps = false;
    protected $guarded =[];
    public function goodsspecs()
    {
        return $this->hasMany('GoodsSpecs','goodsId','goodsId');
    }
    public function GoodsSel($goodsId)
    {
        $dd = $this->with(['goodsspecs'=>function($query) use($goodsId)
        {
            $query->where('goodsId',$goodsId);
        }
        ])->find($goodsId)->toArray();

        if($dd['goodsspecs'] !== null)
        {
            $warnStock= [];
            $warnStockval = [];
            foreach ($dd['goodsspecs'] as $k => $v)
            {

                $dd['goodsspecs'][$k]['warnStock'] = explode(',',rtrim($v['warnStock'],','));
                $dd['goodsspecs'][$k]['warnStockval'] = explode(',',rtrim($v['warnStockval'],','));
            }

        }
        return response(['code'=>'1001','data'=>$dd]);
    }
}
