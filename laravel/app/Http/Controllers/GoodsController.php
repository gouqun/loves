<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\Goods;

class GoodsController extends Controller
{
    //简单的商品列表
    public function GoodsSel(Request $request)
    {
        $post = $request->post();
        return Goods::GoodsSel($post['goodsId']);

    }

    //根据商品分类查询商品列表

    public function SelGoods(Request $request)
    {
        $catskey = $request->get('catskey');
        $shopCatId = $request->get('shopCatId');
        $data = Goods::SelGoods($catskey, $shopCatId);
        if ($data)
        {
            return response(['code'=>'1001','data'=>$data,'msg'=>'请求成功']);
        }else{
            return response(['code'=>'1002','data'=>$data,'msg'=>'请求失败']);
        }
    }
}
