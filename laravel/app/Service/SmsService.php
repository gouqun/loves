<?php
namespace  App\Service;
use Illuminate\Support\Facades\Log;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;
use Illuminate\Support\Facades\Cache;

class SmsService
{
    public static function sendVerifyCode($phone)
    {
        $sms = app('sms');
        try {
            $num =  self::verifyCode($phone);
            $sms->send($phone, [
                //content针对云片平台发送的短信内容
                'content' => '您的验证码是'. $num .'。如非本人操作，请忽略                     本短信',
                //下面两个参数针对腾讯云平台发送短信的参数
                'template' => '1',
                'data' => [
                    //关联短信模板的参数
                    $num,
                    1
                ],
            ],
                //指定使用哪个网关进行发送
                ['yuntongxun']
            );
        } catch (NoGatewayAvailableException $exception) {
            //发送失败，记录错误日志
            echo $exception->getException('yuntongxun')->getMessage();
            }
    }

    public static function verifyCode($phone)
    {
        $num = mt_rand(100000, 999999);
        Cache::store('file')->put($phone,$num,60);
        return $num;
    }

}