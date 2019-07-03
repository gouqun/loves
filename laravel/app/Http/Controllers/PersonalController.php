<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Facades\User;
use App\Facades\UserInf;
use App\Facades\ShopReplys;
use Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;
class PersonalController extends Controller
{
    public  function personaldis(Request  $request)
    {

        try{
            $data = UserInf::find($request->get('user')['user_id']);
            return response()->json(['code'=>'1','message'=>'请求成功','data'=>$data])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }catch (\Exception $e){
            return response()->json(['code'=>'1008','message'=>'查询失败'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);

        }

    }
    public function update(Request $request)
    {
        DB::beginTransaction();
        try{
            $data = $request->only(['customer_name', 'identity_card_type', 'identity_card_no', 'customer_email', 'gender', 'birthday', 'mobile_phone']);
            UserInf::where('user_id', $request->get('user')['user_id'])->update($data);
            $info['mobile_phone'] = $request->post('mobile_phone');
            $info['customer_email'] = $request->post('customer_email');
            User::where('user_id', $request->get('user')['user_id'])->update($info);
            DB::commit();
            return response()->json(['code'=>'1','message'=>'请求成功'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }catch (\Exception $e)
        {
            DB::rollback();
            return response()->json(['code'=>'1010','message'=>'修改失败'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }
    }
    public function news(Request $request)
    {
        return response()->json(['code'=>'1','message'=>'请求成功','data'=>ShopReplys::index($request)])->setEncodingOptions(JSON_UNESCAPED_UNICODE);

    }
}