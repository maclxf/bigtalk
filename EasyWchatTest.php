<?php
require_once __DIR__ . '/vendor/autoload.php';
use Socialite\WechatOfficeAccount;
try {
$wechat = new WechatOfficeAccount();
echo '<pre>';

    $wechat->createQrcode();
} catch(\Throwable$e) {
    echo $e->getMessage();
}


//$wechat = new WechatOfficeAccount();

//$url = $wechat->getTargetUrl();

//echo json_encode(['url' => $url]);
