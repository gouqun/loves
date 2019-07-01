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
        dd($post);
    }

}
