<?php

return [

    // HTTP 请求的超时时间（秒）
    'timeout' => 5.0,
    // 默认发送配置
    'default' => [
        // 网关调用策略，默认：顺序调用
        'strategy' => \Overtrue\EasySms\Strategies\OrderStrategy::class,
        // 默认可用的发送网关
        'gateways' => [
            //云片
//            'yunpian',
            //腾讯云
//            'qcloud',
            //容联云
            'yuntongxun'
        ],
    ],
    // 可用的网关配置
    'gateways' => [
//        'errorlog' => [
//            'file' => '/tmp/easy-sms.log',
//        ],
//        'yunpian' => [
//            'api_key' => '云片短信平台账户api_key',
//        ],
//        'qcloud' => [
//            'sdk_app_id' => '腾讯云短信平台sdk_app_id',
//            'app_key' => '腾讯云短信平台app_key',
//            'sign_name' => '腾讯云短信平太签名'
//            ],
        'yuntongxun' => [
            'app_id' => '8aaf07086772ac6101678663cca314ec',
            'account_sid' => '8aaf07086772ac6101678663cc4d14e6',
            'account_token' => '396017918d704ab883b25bdfdd4f4892',
            'is_sub_account' => false,
        ],
     ],
];