<?php
require_once __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;

$action = $_GET['action'];
$access_key_id = 'dTYMNWlYZDZjYT0M';//'RYTmzTBYjjNlZ3xZ';//zMQGzU54NTZWmjzV
$access_key_secret = 'JYOjljTiZhTNTNhkzNAWNgN2yZTAFzW2YmMhTkYZZDYZzjBN';//

switch ($action) {
	case 'subscrip_request':
		subscrip_request($access_key_secret);
		break;
	case 'push_response':
		push_response();
		break;
	case 'abort_response':
		abort_response();
		break;
	case 'stop_response':
		stop_response();
		break;
	default:
		echo 'Waiting For You';
		break;
}


/**
 * 订阅请求
 * @author lxf 2018-05-10
 * @param  [type] $access_key_secret [description]
 * @return [type]                    [description]
 */
function subscrip_request ($access_key_secret) {
	$param_json = json_encode([
		// 快递公司编码，少量快递公司支持多品牌
		"company" => "ADI",
			//订阅的快递单号
		"code" => "12345678",
			//操作 => order表示订阅，repush表示请求快递公司发起一次全量重推
		"operator" => "order",
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

	var_dump(json_decode($response->getBody()));//json_decode($response->getBody());
}

/**
 * 推送相应
 * @author lxf 2018-05-10
 * @return [type] [description]
 */
function push_response() {
	/*echo '<pre>';
	var_dump($_POST);
	echo '</pre>';*/
	$ret = [
		//推送的结果：true表示成功收到，false表示失败
		"result" => true,
		//推送的结果状态
		"returnCode" => 200,
		//对应状态的文本描述
		"message" => "推送收到"
	];

	echo json_encode($ret);
}

/**
 * abort相应
 * @author lxf 2018-05-10
 * @return [type] [description]
 */
function abort_response() {
	/*echo '<pre>';
	var_dump($_POST);
	echo '</pre>';*/
	$ret = [
		//推送的结果：true表示成功收到，false表示失败
		"result" => true,
		//推送的结果状态
		"returnCode" => 200,
		//对应状态的文本描述
		"message" => "abort推送收到"
	];

	echo json_encode($ret);
}

/**
 * stop相应
 * @author lxf 2018-05-10
 * @return [type] [description]
 */
function stop_response() {
	/*echo '<pre>';
	var_dump($_POST);
	echo '</pre>';*/
	$ret = [
		//推送的结果：true表示成功收到，false表示失败
		"result" => true,
		//推送的结果状态
		"returnCode" => 200,
		//对应状态的文本描述
		"message" => "stop推送收到"
	];

	echo json_encode($ret);
}