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
use Illuminate\Http\Request;
class AddressController extends BaseController
{
    //地址添加
    public function AddressAdd(Request $request){
        $data = Input::post();
        $data['user_id'] = $request->post('user')['user_id'];

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
            return json_encode(['code'=>1009,'msg'=>$error],JSON_UNESCAPED_UNICODE);
        }
        $data['user_id'] = $data['id'];
        $data['areaIdPath'] = $data['province'].'_'.$data['city'].'_'.$data['county'];
        unset($data['id'],$data['province'],$data['city'],$data['county']);
        $res = Address::insert($data);
        if($res){
            return json_encode(['msg'=>'添加成功','code'=>1003],JSON_UNESCAPED_UNICODE);
        }else{
            return json_encode(['msg'=>'添加失败','code'=>1004],JSON_UNESCAPED_UNICODE);
        }

    }
    //地址编辑
    public function AddressUp(Request $request){
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
            return json_encode(['code'=>1009,'msg'=>$error],JSON_UNESCAPED_UNICODE);
        }
        $data['areaIdPath'] = $data['province'].'_'.$data['city'].'_'.$data['county'];
        unset($data['id'],$data['province'],$data['city'],$data['county']);
        $res = Address::where('address_id',$data['address_id'])->update($data);
        if($res){
            return json_encode(['code'=>1005,'msg'=>'修改成功'],JSON_UNESCAPED_UNICODE);
        }else{
            return json_encode(['code'=>1006,'msg'=>'修改失败'],JSON_UNESCAPED_UNICODE);
        }
    }
    //地址删除
    public function AddressDel(Request $request){
        $id = Input::post('address_id');
        $data['user_id'] = $request->post('user')['user_id'];
        $res = Address::where('address_id',$id)->delete();
        if($res){
            return json_encode(['code'=>1007,'msg'=>'删除成功'],JSON_UNESCAPED_UNICODE);
        }else{
            return json_encode(['code'=>1008,'msg'=>'删除失败'],JSON_UNESCAPED_UNICODE);
        }
    }
    public function AddressShow(Request $request){
        $id = $request->post('user')['user_id'];

        $data = Address::where('user_id',$id)->get();
        return json_encode(['code'=>1000,'msg'=>'成功','data'=>$data],JSON_UNESCAPED_UNICODE);
    }
}