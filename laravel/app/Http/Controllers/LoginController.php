<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Facades\User;
use App\Facades\UserInf;
use Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
            $data = $request->post();
            $user = User::where('login_name',$request->post('login_name'))->orWhere('mobile_phone',$request->post('login_name'))->orWhere('customer_email',$request->post('login_name'))->first();
            if(!$user || (decrypt($user->password) != $data['password']))
            {
               return  response()->json(['code' => 1001,'message'=>'用户名密码错误'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
            }
            $token = JWTAuth::fromUser($user);
            $userinf = User::where('user_id',$user->user_id)->with('UserInf')->first()->toarray();
            $name = $userinf['user_inf']['customer_name'] ? $userinf['user_inf']['customer_name'] : 'aaa';
            $duse = ['token'=>$token,'data'=>$name];
            return response()->json(['code'=>1,'message'=>'请求成功','data'=>$duse])->setEncodingOptions(JSON_UNESCAPED_UNICODE);


//        $user = User::first();
//        $token = JWTAuth::fromUser($user);
//        $data = User::login($request->post());
//        if($data)
//        {
//            $token =  JWTAuth::fromUser($data);
//            dd($token);
//        }
    }
    public function logout()
    {
        JWTAuth::parseToken()->invalidate();

        return response()->json(['code'=>2,'message' => '退出成功'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
    public function refresh(Request $request)
    {

        return $this->respondWithToken(JWTAuth::parseToken()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'code'=>'1',
            'message' => '请求成功',
            'data' => $token
        ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
    public function register(Request $request)
    {
        $message = [
            'mobile_phone.required' => '请填写手机号',
            'mobile_phone.unique' => '手机号已被注册',
            'mobile_phone.regex' => '手机号格式不正确',
            'login_name.required' => '请填写登陆名称',
            'login_name.unique' => '登录名已被注册',
            'login_name.between' => '登录名在3-20个字符',
            'customer_email.required' => '邮箱不能为空',
            'customer_email.email' => '邮箱不正确',
            'password.required' => '请输入密码',
            'password.alpha_num' => '密码为数字和字母',
            'password.between' => '密码在3-20数字和字母'
        ];
        $validator = Validator::make($request->post(), [
            'mobile_phone' => 'required|unique:user_login|regex:/^1[345789][0-9]{9}$/',
            'login_name' => 'required|unique:user_login|between:3,20',
            'customer_email' => 'required|email',
            'password' => 'required|alpha_num|between:6,20'
        ],$message);

        if ($validator->fails()) {
            return response()->json(['code'=>1006,'message' => $validator->errors()->first()])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }
        $data = $request->post();
        try{
            $data['password'] = encrypt($data['password']);
            $info = User::create($data);
            $token = JWTAuth::fromUser($info);
            return response()->json(['code' => 1,'message'=>'请求成功','data' => $token])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }catch (\Exception $exception)
        {
            return response()->json(['code'=>2,'message'=>'注册失败'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }
    }
    public function password(Request $request)
    {

        $message = [
            'mobile_phone.required' => '请填写手机号',
            'login_name.required' => '请填写登陆名称',
            'password.required' => '请输入密码',
            'new_password.required' => '请输入确认密码',
        ];
        $validator = Validator::make($request->post(), [
            'mobile_phone' => 'required',
            'login_name' => 'required',
            'password' => 'required',
            'new_password' => 'required',
        ],$message);

        if ($validator->fails()) {
            return response()->json(['code'=>1006,'message' => $validator->errors()->first()])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }
        $info = $request->only(['mobile_phone','login_name']);
        $data = $request->only(['mobile_phone','login_name','password']);
        $user = User::where($info)->first();
        if(!$user || (decrypt($user->password) != $data['password']))
        {
            return  response()->json(['code' => 1008,'message'=>'用户名密码或手机号错误'])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }
        $user->password = $request->post('new_password');
        $user->save();
        return response()->json(['code' => 1,'message'=>'请求成功','data' => JWTAuth::fromUser($user)])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}
