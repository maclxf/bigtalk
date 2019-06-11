<?php
require_once __DIR__ . '/vendor/autoload.php';

use Socialite\WechatOfficeAccount;

$wechat = new WechatOfficeAccount();
echo '<pre>';
$wechat->sendTemplate();
