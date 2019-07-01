<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
class Login  extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $token = JWTAuth::getToken();
//        if(!$token)
//        {
//            return response()->json(['code'=>1003,'message'=>'请传入token']);
//        }
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {  //获取到用户数据，并赋值给$user
                return response()->json([
                    'code' => 1004,
                    'message' => '无用户信息'

                ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
            }
            $request->attributes->add(['user'=>$user->toarray()]);//添加参数

            return $next($request);

    } catch (TokenExpiredException $e) {

            return response()->json([
                'code' => 1003,
                'message' => 'token过期' , //token已过期
            ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        } catch (TokenInvalidException $e) {

            return response()->json([
                'code' => 1002,
                'message' => 'token无效',  //token无效
            ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);

        } catch (JWTException $e) {

            return response()->json([
                'code' => 1005,
                'message' => '缺少token' , //token为空
            ])->setEncodingOptions(JSON_UNESCAPED_UNICODE);

        }

    }



}
