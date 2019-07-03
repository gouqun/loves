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
            $query->select('goodsId','specPrice','specImg','warnStockval')->where('goodsId',$goodsId)->where('dataFlag','1');
        }
        ])->find($goodsId)->toArray();

        $dd['goodsImg'] = explode(',',rtrim($dd['goodsImg'],','));
        foreach ($dd['goodsImg'] as $k =>$v)
        {
           $dd['goodsImg'][$k] =  env('HTTP_IMG').$v;
        }
        if($dd['goodsspecs'] !== null)
        {
            foreach ($dd['goodsspecs'] as $k => $v)
            {
                $dd['goodsspecs'][$k] =[
                    'img' => env('HTTP_IMG').$v['specImg'],
                    'price' => (float)$v['specPrice'],
                    'intro' => str_replace(',','-',rtrim($v['warnStockval'],','))
                ];

            }
        }
        $dd['marketPrice'] = (float)$dd['marketPrice'];

        return response(['code'=>'1001','data'=>$dd]);
    }
    public function SelGoods($catskey,$shopCatId)
    {

       return $this->where($catskey,$shopCatId)->where('dataFlag','1')->select('goodsName','shopPrice','brandId','appraiseNum','goodsImg')->paginate(16)->toarray();

    }
}
