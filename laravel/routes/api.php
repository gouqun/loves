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
//订单
Route::post('nonpayment','OrderController@NonPayment');
Route::post('OrderAll','OrderController@OrderAll');
Route::post('NoReceiving','OrderController@NoReceiving');
Route::post('NoComment','OrderController@NoComment');

//地址
Route::post('AddressAdd','AddressController@AddressAdd');
Route::post('AddressUp','AddressController@AddressUp');
Route::post('AddressDel','AddressController@AddressDel');
Route::post('AddressShow','AddressController@AddressShow');
