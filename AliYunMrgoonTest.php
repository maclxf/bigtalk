<?php
require_once __DIR__ . '/vendor/autoload.php';

// 阿里云Access Key ID和Access Key Secret 从 https://ak-console.aliyun.com 获取
$appKey = 'LTAIBBztUqi6cEPP';
$appSecret = 'QC4VDQ1NtgwKmSScvF3kC5NWtm2ijq';

// 短信签名 详见：https://dysms.console.aliyun.com/dysms.htm?spm=5176.2020520001.1001.3.psXEEJ#/sign
$signName  = '易多客';

$config = [
    'access_key' => 'LTAIBBztUqi6cEPP',
    'access_secret' => 'QC4VDQ1NtgwKmSScvF3kC5NWtm2ijq',
    'sign_name' => '易多客',
];

$aliSms = new Mrgoon\AliSms\AliSms();
$response = $aliSms->sendSms('17316743392', 'SMS_102900017', ['code'=> '677111'], $config);

var_dump($response);