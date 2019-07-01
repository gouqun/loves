<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\SmsService;
use Illuminate\Support\Facades\Cache;
use App\Facades\User;

class TelController extends Controller
{
    public function index(Request $request)
    {
        if(isset($request->phone))
        {
            SmsService::sendVerifyCode($request->phone);
            return  response()->json(['code' => 1,'message'=>'验证码已发送，注意查收'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);

        }
    }
    public function telcode(Request $request)
    {
        if(Cache::has($request->post('phone')))
        {
            $data = Cache::store('file')->get($request->post('phone'));
            if($request->post('code') == $data)
            {
                return  response()->json(['code' => 1,'message'=>'验证码正确','data'=>$request->post('phone')])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
            }
            return  response()->json(['code' => 1012,'message'=>'验证码错误'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);

        }
        else
        {
            return  response()->json(['code' => 1011,'message'=>'验证码过期'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }
    }
}
