<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\GoodsCats;

class GoodsCatsController extends Controller
{
    //简单的商品列表
    public function GoodsCatsSel(Request $request)
    {
        $post = $request->post();
        $data = GoodsCats::CatsSel($post['catId']);
        return response([
            'data'=>$data
        ],'201');
    }

}
