<?php
require_once __DIR__ . '/vendor/autoload.php';

use Aliyun\Core\Config as AliyunConfig;
use Aliyun\Core\Profile\DefaultProfile;
use Aliyun\Core\DefaultAcsClient;
use Aliyun\Api\Sms\Request\V20170525\SendSmsRequest;
use Aliyun\Api\Sms\Request\V20170525\QuerySendDetailsRequest;

// 阿里云Access Key ID和Access Key Secret 从 https://ak-console.aliyun.com 获取
$appKey = 'LTAIBBztUqi6cEPP';
$appSecret = 'QC4VDQ1NtgwKmSScvF3kC5NWtm2ijq';

// 短信签名 详见：https://dysms.console.aliyun.com/dysms.htm?spm=5176.2020520001.1001.3.psXEEJ#/sign
$signName  = '易多客';

// 短信模板Code https://dysms.console.aliyun.com/dysms.htm?spm=5176.2020520001.1001.3.psXEEJ#/template
$template_code = 'SMS_102900017';

// 短信中的替换变量json字符串
$json_string_param = json_encode(['code' => '1111']);

// 接收短信的手机号码
$phone = '17316743392';

// 初始化阿里云config
AliyunConfig::load();
// 初始化用户Profile实例
$profile = DefaultProfile::getProfile("cn-hangzhou", $appKey, $appSecret);
DefaultProfile::addEndpoint("cn-hangzhou", "cn-hangzhou", "Dysmsapi", "dysmsapi.aliyuncs.com");
$acsClient = new DefaultAcsClient($profile);
// 初始化SendSmsRequest实例用于设置发送短信的参数
$request = new SendSmsRequest();
// 必填，设置短信接收号码
$request->setPhoneNumbers($phone);
// 必填，设置签名名称
$request->setSignName($signName);
// 必填，设置模板CODE
$request->setTemplateCode($template_code);

// 可选，设置模板参数
if(!empty($json_string_param)) {
    $request->setTemplateParam($json_string_param);
}
// 可选，设置流水号
// if($outId) {
//     $request->setOutId($outId);
// }

// 发起请求
$acsResponse =  $acsClient->getAcsResponse($request);

// 默认返回stdClass，通过返回值的Code属性来判断发送成功与否
if($acsResponse && strtolower($acsResponse->Code) == 'ok')
{
    return true;
}
return false;