<?php
require_once('Socialite/WechatOfficeAccount.php');
$wechat = new WechatOfficeAccount();
$wechat->getUser();
