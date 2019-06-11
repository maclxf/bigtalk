<?php
require_once __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;

$client = new \GuzzleHttp\Client();

$data = [
	// 快递公司编码，少量快递公司支持多品牌
	"company" => "ADI",
		//订阅的快递单号
	"code" => "BT1525065737",
		//操作 => order表示订阅，repush表示请求快递公司发起一次全量重推
	"operator" => "repush",
	// 回调参数，快递100需要的附加参数，在推送时需提供，不多于32字节的文本
	"callback" => "http://www.kuaidi100.com/xxx"
];

$response = $client->request('POST', 'http://adi-fr.dev/notify_url_test/alipay', ['form_params' => $data]);
$body = $response->getBody();
echo $body->getContents();