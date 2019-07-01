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

