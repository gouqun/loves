<?php

namespace App\Http\Controllers;

use App\Model\Order;
use App\Model\Address;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    //待支付
    public function NonPayment(Request $request){
        $id = $request->post('user')['user_id'];
        $list = Order::page($id,-2);
        if($list){
            return json_encode(['code'=>1001,'msg'=>'查询成功','list'=>$list], JSON_UNESCAPED_UNICODE);
        }else{
            return json_encode(['code'=>1002,'msg'=>'查询失败'], JSON_UNESCAPED_UNICODE);
        }

    }
    //待收货
    public function NoReceiving(Request $request){
        $id = $request->post('user')['user_id'];
        $list = Order::page($id,1);
        if($list){
            return json_encode(['code'=>1001,'msg'=>'查询成功','list'=>$list,], JSON_UNESCAPED_UNICODE);
        }else{
            return json_encode(['code'=>1002,'msg'=>'查询失败'], JSON_UNESCAPED_UNICODE);
        }

    }
    //待评价
    public function NoComment(Request $request){
        $id = $request->post('user')['user_id'];
        $list = Order::comment($id);
        if($list){
            return json_encode(['code'=>1001,'msg'=>'查询成功','list'=>$list], JSON_UNESCAPED_UNICODE);
        }else{
            return json_encode(['code'=>1002,'msg'=>'查询失败'], JSON_UNESCAPED_UNICODE);
        }

    }
    //全部订单
    public function OrderAll(Request $request){
        $id = $request->post('user')['user_id'];
        $list = Order::OrderAll($id);
        if($list){
            return json_encode(['code'=>1001,'msg'=>'查询成功','list'=>$list], JSON_UNESCAPED_UNICODE);
        }else{
            return json_encode(['code'=>1002,'msg'=>'查询失败'], JSON_UNESCAPED_UNICODE);
        }
    }
    //立即下单列表
    public function OrderList(Request $request)
    {
        $post = $request->post();
        $address = Address::AddressSel($post['user_id']);
        $post['goodMoney'] = $post['shopPrice'] * $post['goodsNum'];
        return response(['code'=>'102','data'=>$post,'address'=>$address]);
    }
    //添加订单
    public function OrderAdd(Request $request)
    {
        $post = $request->post();
        return Order::OrderAdd($post);
    }
}