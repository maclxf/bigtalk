<?php
namespace Socialite;

abstract class Socialite {

    public static function getWechatOfficeAccount() {
        return [
            'app_id' => 'wx1449186a2cae1946',
            'secret' => '48f72e182437420a56a663ebc076ced7',
            /*'oauth' => [
                'scopes'   => ['snsapi_userinfo'],
                'callback' => 'callback/oauth2_callback',
            ],*/
            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            //'response_type' => 'array',
            'oauth' => [
                'scopes'   => ['snsapi_userinfo'],
                'callback' => 'wechatOuath.php',
            ],
        ];


    }
}
