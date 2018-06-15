<?php
require_once __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;


$access_key_id = 'dTYMNWlYZDZjYT0M';//'RYTmzTBYjjNlZ3xZ';//zMQGzU54NTZWmjzV
$access_key_secret = 'JYOjljTiZhTNTNhkzNAWNgN2yZTAFzW2YmMhTkYZZDYZzjBN';//'MNTBdNEOE2yZNNDRjZgYTMj0MOYxzhlYTIMZYAhMYBO2lDzj';//2NZ0ITWYO5Tc2MAUTIT2zkT2E2iIN4N3EkxYG0MNDVYYjlmx
$time = time();
$post_data = array(
    'access_key_id' => $access_key_id,
    'timestamp'     => $time,
    //'format'=> 'u'
);
ksort($post_data);

$signature_str = http_build_query($post_data, '', '&', PHP_QUERY_RFC3986);
$signature = md5($signature_str . '&access_key_secret=' . $access_key_secret);

$post_data['signature'] = $signature;

/*************************发送请求的各种法师****************************/


//$client = new \GuzzleHttp\Client();
/*发送json方式1*/
//$post_json = json_encode($post_data, JSON_UNESCAPED_UNICODE);
//$response = $client->request('post', 'http://adi-fr.dev/request-entry/v1/kuaidi100', ['body' => $post_json]);

/*发送arr方式2*/
//$response = $client->request('post', 'http://adi-fr.dev/v1/gettime', [
//    'json' => $post_data
//]);
//
/***********************************************************************/


/*$client = new \GuzzleHttp\Client(['base_uri' => 'http://adi-fr.dev/']);
//$response = $client->request('POST', 'gettime');
$response = $client->request('post', 'invoke-entry/v1/gettime', [
    'json' => $post_data
]);*/



/*<form action=" http://www.xxxx.com/track/order.do "  method="post">
	<input type="hidden" name="param" value="json参数"/>
	<input type="hidden" name="sign" value="md5"/>
	<input type="hidden" name="customer" value="kuaidi100"/>
</form>

其中，param参数为json格式，如Demo所示：
{
	// 快递公司编码，少量快递公司支持多品牌
	"company":"xxxx",
		//订阅的快递单号
	"code":"12345678",
		//操作:order表示订阅，repush表示请求快递公司发起一次全量重推
	"operator":"order",
	// 回调参数，快递100需要的附加参数，在推送时需提供，不多于32字节的文本
	"callback":"http://www.kuaidi100.com/xxx"
}

sign参数为签名值，sign=md5(param+key)，约定key:快递公司和快递100约定一个密钥。
*/














/******************************************post 表单提交*******************************************************/
$param_json = json_encode([
	// 快递公司编码，少量快递公司支持多品牌
	"company" => "ADI",
		//订阅的快递单号
	"code" => "BT1525065737",
		//操作 => order表示订阅，repush表示请求快递公司发起一次全量重推
	"operator" => "repush",
	// 回调参数，快递100需要的附加参数，在推送时需提供，不多于32字节的文本
	"callback" => "http://www.kuaidi100.com/xxx"
]);

$data = [
	'param' => $param_json,
	'sign' => md5($param_json . $access_key_secret),
	'customer' => 'kuaidi100'
];


$client = new \GuzzleHttp\Client();

$response = $client->request('post', 'http://adi-fr.dev/request-entry/v1/kuaidi100', ['form_params' => $data]);
$body = $response->getBody();
echo $body->getContents();
