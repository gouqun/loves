<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\GoodsCats;

class GoodsCatsController extends Controller
{
    //简单的商品列表
    public function GoodsCatsSel(Request $request)
    {
        $data = GoodsCats::CatsSel();
        return response([
            'code'=>1001,
            'data'=>$data
        ],'201');
    }

}
