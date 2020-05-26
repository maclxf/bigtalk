<?php
require_once __DIR__ . '/vendor/autoload.php';

use Socialite\WechatOfficeAccount;

$wechat = new WechatOfficeAccount();

$user = $wechat->getOauthUser();
$user = $user->getOriginal();
//echo json_encode($_GET);
if ($user['nickname']) {
	header("Location: http://localhost:8080/success?nickname=" . $user['nickname']);
} else {
	header("Location: http://localhost:8080/failed");
}