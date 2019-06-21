<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table ='shop_order';
    public $timestamps = false;
    public static function page($id,$i){
        return Order::join('shop_order_goods','shop_order.orderId','=','shop_order_goods.orderId')
            ->where(["shop_order.userid"=>$id,'shop_order.orderStatus'=>$i])
            ->select('shop_order.orderId','shop_order.orderNo','shop_order.userid','shop_order.orderStatus','shop_order.payType','shop_order.totalMoney','shop_order.isPay','shop_order.userName','shop_order.createTime','shop_order.userAddress','shop_order.userPhone','shop_order_goods.*')->get()->toArray();
    }
    public static function OrderAll($id){
        return Order::join('shop_order_goods','shop_order.orderId','=','shop_order_goods.orderId')
            ->where(["shop_order.userid"=>$id])
            ->select('shop_order.orderId','shop_order.orderNo','shop_order.userid','shop_order.orderStatus','shop_order.payType','shop_order.totalMoney','shop_order.isPay','shop_order.userName','shop_order.createTime','shop_order.userAddress','shop_order.userPhone','shop_order_goods.*')->get()->toArray();
    }
    public static function comment($id){
        return Order::join('shop_order_goods','shop_order.orderId','=','shop_order_goods.orderId')
            ->where(["shop_order.userid"=>$id,'shop_order.isAppraise'=>0])
            ->select('shop_order.orderId','shop_order.orderNo','shop_order.userid','shop_order.orderStatus','shop_order.payType','shop_order.totalMoney','shop_order.isPay','shop_order.userName','shop_order.createTime','shop_order.userAddress','shop_order.userPhone','shop_order_goods.*')->get()->toArray();
    }
}