<?php
namespace App\Http\Controllers;
use app\Models\Goods;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class RecommendController extends Controller{
    //为您推荐
    public function recommend(Request $request){
        $uid = $request->input('uid');
        $data = DB::table('shop_look')->where('uid',$uid)->join('shop_good','shop_look.gid','=','shop_good.goodsId')->orderBy('visitNum','desc')->limit(10)->select('shop_good.goodsName','shop_good.goodsImg','shop_good.shopPrice')->get();
        if ($data){
            return response()->json(['code' => Response::HTTP_OK,'msg' => '请求成功','data' => $data]);
        }
        else{
            return response()->json(['code' => Response::HTTP_BAD_REQUEST,'msg' => '请求失败','data' => null]);
        }
    }
}


?>