<?php
require_once __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;

//http://183.57.45.146:9201/ctcs-api/api/personal/PUSHORDER
//token:e1236b0107fd438b, tokenKey:

$token = 'e1236b0107fd438b';
$tokenKey = '90fbd59a6750c8a5';
$url = 'http://183.57.45.146:9201/ctcs-api/api/personal/PUSHORDER';//getLable

$type = 'PER';
$returnMode = 'sync';
$warehouseCode = 'ZHK01';
$shipWay = 'ETK';


$content = [
	'orderCode' => 'BT12345672',
	'shipWay'   => $shipWay,
	'warehouseCode' => $warehouseCode,

	//merchantId all
	//sendCountryCode all
	//dutyPaid PER
	'downloadPdf' => true,
	//smallTicketFile PER

	'totalWeight' => '2600',

	'receiverName' => '王老三',
	//'receiverPhone' => '1339988111',
	'receiverMobile' => '13466991121',
	'receiverAddress' => '后街18-1',
	'receiverProvince' => '北京市',
	'receiverCity' => '北京市',
	'receiverCounty' => '朝阳区',

	'receiverZip' => '6699111',
	//receiverCardNo
	'Items' => [
		[
			'productName' => '爱的色放',
			//productEnName,
			'unit' => 'testUnit',
			//qualityCertify,
			'productCount' => '2',
			'netWeight' => '200',
			'grossWeight' => '300',
			'price' => '112',
			'currency' => 'RMB',
			//postTaxNum
			'originCountry' => 'FR'
		]
	]
];


/*$content = [
	"trackingNo" => 'EL523878271HK'
];*/
$content_json = json_encode($content);




$post = [
	'content' => $content_json,
	'token' => $token,
	'sign' => strtoupper(md5(($tokenKey . $content_json))),
	'type' => $type,//个人
	'returnMode' => $returnMode//(仅针对BC)返回⽅式async:异步(默认) sync同步(推荐使⽤)(PER只⽀持同步）
];

/*[
    'headers' => ['Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'],

],*/

$client = new \GuzzleHttp\Client();
$response = $client->request('POST', $url, [
        'form_params' => $post
    ]);

$body = $response->getBody();


$ret_json =  $body->getContents();

$ret = json_decode($ret_json);

var_dump($ret);


