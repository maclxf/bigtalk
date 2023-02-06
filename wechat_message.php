<?php
require_once __DIR__ . '/vendor/autoload.php';
use Socialite\WechatOfficeAccount;

$signature = $_GET["signature"];
$timestamp = $_GET["timestamp"];
$nonce = $_GET["nonce"];

$token = 'Hello';
$tmpArr = array($token, $timestamp, $nonce);
sort($tmpArr, SORT_STRING);
$tmpStr = implode( $tmpArr );
$tmpStr = sha1( $tmpStr );

if( $tmpStr == $signature ){
    echo $_GET['echostr'];
    $json = file_get_contents('php://input');

    file_put_contents('a.txt',$json);
}else{
    return false;
}