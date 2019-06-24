<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\Collect;

class CollectController extends Controller
{
    //
    public function CollectAdd(Request $request)
    {

        $post = $request->post();
        $res = Collect::CollectAdd($post);
        if($res)
        {
            return response(['code'=>'1001','msg'=>'添加成功'],'201');
        }else{
            return response(['code'=>'1002','msg'=>'添加失败'],'201');
        }
    }
}
