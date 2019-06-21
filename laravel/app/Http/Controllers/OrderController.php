<?php

namespace App\Http\Controllers;

use App\Model\Order;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
class OrderController extends BaseController
{
    //待支付
    public function NonPayment(){
        $id = Input::post('id');
        $list = Order::page($id,-2);
        return json_encode(['list'=>$list,'msg'=>0], JSON_UNESCAPED_UNICODE);
    }
    //待收货
    public function NoReceiving(){
        $id = Input::post('id');
        $list = Order::page($id,1);
        return json_encode(['list'=>$list,'msg'=>0], JSON_UNESCAPED_UNICODE);
    }
    //待评价
    public function NoComment(){
        $id = Input::post('id');
        $list = Order::comment($id);
        return json_encode(['list'=>$list,'msg'=>0], JSON_UNESCAPED_UNICODE);
    }
    //全部订单
    public function OrderAll(){
        $id = Input::post('id');
        $list = Order::OrderAll($id);
        return json_encode(['list'=>$list,'msg'=>0], JSON_UNESCAPED_UNICODE);
    }

}