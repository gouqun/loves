<?php

namespace App\Http\Controllers;

use App\Model\Address;
use App\Model\Order;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Validator;
class AddressController extends BaseController
{
    //地址添加
    public function AddressAdd(){
        $data = Input::post();
        $rules = [
            'name' => 'required|max:20|regex:/\p{Han}/u',
            'address' => 'required|max:200',
            'mobile' => 'required|max:11|min:11',
        ];
        $message = [
            'name.required' => '收件人不能为空',
            'name.max' => '收件人名称过长',
            'name.regex' => '收件人名称必须是汉字',
            'address.required' => '地址不能为空',
            'address.max' => '地址过长',
            'mobile.required' => '手机号不能为空',
            'mobile.max' => '手机号规格不对',
            'mobile.min' => '手机号规格不对',
        ];
        $validate=Validator::make($data,$rules,$message);
        if(!$validate->passes()){
            $errors = $validate->messages()->all();
            $error = implode('/n',$errors);
            return json_encode(['error'=>$error,'msg'=>1],JSON_UNESCAPED_UNICODE);
        }
        $data['user_id'] = $data['id'];
        unset($data['id']);
        $res = Address::insert($data);
        if($res){
            return json_encode(['success'=>'成功','msg'=>0],JSON_UNESCAPED_UNICODE);
        }else{
            return json_encode(['error'=>'失败','msg'=>1],JSON_UNESCAPED_UNICODE);
        }

    }
    //地址编辑
    public function AddressUp(){
        $data = Input::post();
        $rules = [
            'name' => 'required|max:20|regex:/\p{Han}/u',
            'address' => 'required|max:200',
            'mobile' => 'required|max:11|min:11',
        ];
        $message = [
            'name.required' => '收件人不能为空',
            'name.max' => '收件人名称过长',
            'name.regex' => '收件人名称必须是汉字',
            'address.required' => '地址不能为空',
            'address.max' => '地址过长',
            'mobile.required' => '手机号不能为空',
            'mobile.max' => '手机号规格不对',
            'mobile.min' => '手机号规格不对',
        ];
        $validate=Validator::make($data,$rules,$message);
        if(!$validate->passes()){
            $errors = $validate->messages()->all();
            $error = implode('/n',$errors);
            return json_encode(['error'=>$error,'msg'=>1],JSON_UNESCAPED_UNICODE);
        }
        unset($data['id']);
        $res = Address::where('address_id',$data['address_id'])->update($data);
        if($res){
            return json_encode(['success'=>'成功','msg'=>0],JSON_UNESCAPED_UNICODE);
        }else{
            return json_encode(['error'=>'失败','msg'=>1],JSON_UNESCAPED_UNICODE);
        }
    }
    //地址删除
    public function AddressDel(){
        $id = Input::post('id');
        $res = Address::where('address_id',$id)->delete();
        if($res){
            return json_encode(['success'=>'成功','msg'=>0],JSON_UNESCAPED_UNICODE);
        }else{
            return json_encode(['error'=>'失败','msg'=>0],JSON_UNESCAPED_UNICODE);
        }
    }
    public function AddressShow(){
        $id = Input::post('id');
        $data = Address::where('user_id',$id)->get();
        return json_encode(['success'=>'成功','msg'=>0,'data'=>$data],JSON_UNESCAPED_UNICODE);
    }
}