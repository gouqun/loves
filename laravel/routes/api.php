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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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
