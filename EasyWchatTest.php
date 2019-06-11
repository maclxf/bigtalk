<?php
require_once __DIR__ . '/vendor/autoload.php';

use Socialite\WechatOfficeAccount;

$wechat = new WechatOfficeAccount();
$wechat->getDataCube();
