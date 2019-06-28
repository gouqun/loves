<?php
namespace App\Http\Controllers;
use App\Models\Collect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CollectController extends Controller{
    //我的收藏列表
    public function show(Request $request){
        $uid = $request->input('uid');
        $data = DB::table('shop_collect')->where('uid',$uid)->join('shop_good','shop_collect.gid','=','shop_good.goodsId')->select('shop_good.goodsName','shop_good.goodsImg','shop_good.shopPrice','shop_collect.addtime')->get();
        if ($data){
            return response()->json(['code' => Response::HTTP_OK,'msg' => '请求成功','data' => $data]);
        }
        else{
            return response()->json(['code' => Response::HTTP_BAD_REQUEST,'msg' => '请求失败','data' => null]);
        }
    }
    //取消收藏
    public function cancel(Request $request){
        $uid = $request->input('uid');
        $gid = $request->input('gid');
        $res = Collect::where('uid',$uid)->where('gid',$gid)->delete();
        if ($res){
            return response()->json(['code' => Response::HTTP_OK,'msg' => '请求成功','data' => $res]);
        }
        else{
            return response()->json(['code' => Response::HTTP_BAD_REQUEST,'msg' => '请求失败','data' => null]);
        }
    }
}


?>