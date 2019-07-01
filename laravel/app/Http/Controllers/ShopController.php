<?php
namespace App\Http\Controllers;
use App\Models\Goods;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ShopController extends Controller{
    //购物车列表
    public function index(Request $request){
        $uid = $request->input('uid');
        $res = Cart::where('uid',$uid)->get()->toArray();
        //print_r($res);die;
        if (empty($res)){
            return response()->json(['code' => Response::HTTP_BAD_GATEWAY,'msg' => '用户不存在','data' => null]);
        }
        $data = DB::table('shop_cart')->where('uid',$uid)->join('shop_good','shop_cart.gid','=','shop_good.goodsId')->join('shop_goods_attributes','shop_cart.aid','=','shop_goods_attributes.attrId')->select('shop_good.goodsName','shop_good.goodsImg','shop_good.marketPrice','shop_goods_attributes.attrName','shop_cart.count','shop_cart.price')->get()->toArray();
        if ($data){
            return response()->json(['code' => Response::HTTP_OK,'msg' => '请求成功','data' => $data]);
        }
        else{
            return response()->json(['code' => Response::HTTP_BAD_REQUEST,'msg' => '请求失败','data' => null]);
        }
    }
    //删除购物车中的商品
    public function delete(Request $request){
        $uid = $request->input('uid');
        $gid = $request->input('gid');
        $aid = $request->input('aid');
        $res = Cart::where('uid',$uid)->where('gid',$gid)->where('aid',$aid)->delete();
        if ($res){
            return response()->json(['code' => Response::HTTP_OK,'msg' => '请求成功','data' => $res]);
        }
        else{
            return response()->json(['code' => Response::HTTP_BAD_REQUEST,'msg' => '请求失败','data' => null]);
        }
    }
    //修改信息
    public function update(Request $request){
        $uid = $request->input('uid');
        $gid = $request->input('gid');
        $aid = $request->input('aid');
        $count = $request->input('count');
        $arr = Goods::where('goodsId',$gid)->first();
        $price = $arr['shopPrice']*$count;
        $res1 = Cart::where('uid',$uid)->get();
        if (!$res1){
            return response()->json(['code' => Response::HTTP_NO_CONTENT,'msg' => '用户不存在','data' => null]);
        }
        $res = Cart::where('uid',$uid)->where('gid',$gid)->update(['count' => $count,'price' => $price,'aid' => $aid]);
        if ($res){
            return response()->json(['code' => Response::HTTP_OK,'msg' => '请求成功','data' => $res]);
        }
        else{
            return response()->json(['code' => Response::HTTP_BAD_REQUEST,'msg' => '请求失败','data' => null]);
        }
    }
}


?>