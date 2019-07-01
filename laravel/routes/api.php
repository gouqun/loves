<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('classifyList', 'ClassController@classList');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//购物车列表
Route::any('index','ShopController@index');
//删除购物车商品
Route::any('delete','ShopController@delete');
//修改商品数量
Route::any('update','ShopController@update');
//我的收藏列表
Route::any('show','CollectController@show');
//取消收藏
Route::any('cancel','CollectController@cancel');
//为您推荐
Route::any('recommend','RecommendController@recommend');

//订单
Route::post('nonpayment','OrderController@NonPayment');
Route::post('OrderAll','OrderController@OrderAll');
Route::post('NoReceiving','OrderController@NoReceiving');
Route::post('NoComment','OrderController@NoComment');
Route::post('OrderAdd','OrderController@OrderAdd');
Route::post('OrderList','OrderController@OrderList');

//地址
Route::post('AddressAdd','AddressController@AddressAdd');
Route::post('AddressUp','AddressController@AddressUp');
Route::post('AddressDel','AddressController@AddressDel');
Route::post('AddressShow','AddressController@AddressShow');


//商品详情
Route::post('GoodsSel','GoodsController@GoodsSel');
//商品分类
Route::post('GoodsCats','GoodsCatsController@GoodsCatsSel');
//商品收藏
Route::post('CollectAdd','CollectController@CollectAdd');



Route::post('login', 'LoginController@login');//登陆
Route::post('register', 'LoginController@register');//注册
Route::post('refresh', 'LoginController@refresh');//以旧换新

Route::post('passwordreset', 'LoginController@password');//重置密码
Route::post('phone', 'TelController@index');//发送短信验证码
Route::post('phonecode', 'TelController@telcode');//验证短信验证码


Route::group([
    'prefix' => 'auth',
    'middleware' => 'login'
], function ($router) {

    Route::post('logout', 'LoginController@logout');//退出登陆
    Route::post('personaldis', 'PersonalController@personaldis');//个人信息展示
    Route::post('update', 'PersonalController@update');//个人信息展示
    Route::post('news', 'PersonalController@news');//我的消息

});
