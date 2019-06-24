<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table ='shop_order';
    public $timestamps = false;
    protected $guarded = [];
    public static function page($id,$i){
        return Order::join('shop_order_goods','shop_order.orderId','=','shop_order_goods.orderId')
            ->where(["shop_order.userid"=>$id,'shop_order.orderStatus'=>$i])
            ->select('shop_order.orderId','shop_order.orderNo','shop_order.userid','shop_order.orderStatus','shop_order.payType','shop_order.totalMoney','shop_order.isPay','shop_order.userName','shop_order.createTime','shop_order.userAddress','shop_order.userPhone','shop_order_goods.*')
            ->get()
            ->toArray();
    }
    public static function OrderAll($id){
        return Order::join('shop_order_goods','shop_order.orderId','=','shop_order_goods.orderId')
            ->where(["shop_order.userid"=>$id])
            ->select('shop_order.orderId','shop_order.orderNo','shop_order.userid','shop_order.orderStatus','shop_order.payType','shop_order.totalMoney','shop_order.isPay','shop_order.userName','shop_order.createTime','shop_order.userAddress','shop_order.userPhone','shop_order_goods.*')
            ->get()
            ->toArray();
    }
    public static function comment($id){
        return Order::join('shop_order_goods','shop_order.orderId','=','shop_order_goods.orderId')
            ->where(["shop_order.userid"=>$id,'shop_order.isAppraise'=>0])
            ->select('shop_order.orderId','shop_order.orderNo','shop_order.userid','shop_order.orderStatus','shop_order.payType','shop_order.totalMoney','shop_order.isPay','shop_order.userName','shop_order.createTime','shop_order.userAddress','shop_order.userPhone','shop_order_goods.*')
            ->get()
            ->toArray();
    }
    public static function OrderAdd($post)
    {

        //生成订单号
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        //英文字母、年月日、Unix 时间戳和微秒数、随机数
        $orderNo = $yCode[intval(date('Y')) - 2019] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
        $year_code = array('a','b','c','d','e','f','g','h','i','j');
        $order = Order::where('userid',$post['userid'])->where('orderNo',$orderNo)->first();
        
        if($order)
        {
            return response(['code'=>'1003','msg'=>'您已经下过单了，请不要重复下单']);
        }else{
            $orderunique = $year_code[intval(date('Y'))-2019]. strtoupper(dechex(date('m'))).date('d'). substr(time(),-5).substr(microtime(),2,5).sprintf('%02d',rand(0,99));
            $dataFlag = 1;

            $data = [
                'orderNo'=>$orderNo,
                'userid'=>$post['userid'],
                'goodMoney'=>$post['goodMoney'],
                'deliverType'=>$post['deliverType'],
                'deliverMoney'=>$post['deliverMoney'],
                'totalMoney'=>$post['deliverMoney']+$post['goodMoney'],
                'realTotalMoney'=>$post['realTotalMoney'],
                'payType'=>$post['payType'],
                'userName'=>$post['userName'],
                'userAddress'=>$post['userAddress'],
                'userPhone'=>$post['userPhone'],
                'orderScore'=>$post['orderScore'],
                'isInvoice'=>$post['isInvoice'],
                'invoiceClient'=>$post['invoiceClient'],
                'orderRemarks'=>$post['orderRemarks'],
                'orderunique'=>$orderunique,
                'dataFlag'=>$dataFlag,
                'createTime'=>date('Y-m-d H:i:s',time()),
                'areaId'=>$post['areaId'],
                'areaIdPath'=>$post['areaIdPath']
            ];
            $res = Order::create($data);
            if($res)
            {
                return response(['code'=>'1001','msg'=>'下单成功']);
            }else{
                return response(['code'=>'1002','msg'=>'下单失败，请重新检查数据']);
            }
        }

    }
}