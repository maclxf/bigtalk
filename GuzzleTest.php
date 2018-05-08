<?php
require_once __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;


$access_key_id = 'dTYMNWlYZDZjYT0M';//'RYTmzTBYjjNlZ3xZ';//zMQGzU54NTZWmjzV
$access_key_secret = 'JYOjljTiZhTNTNhkzNAWNgN2yZTAFzW2YmMhTkYZZDYZzjBN';//'MNTBdNEOE2yZNNDRjZgYTMj0MOYxzhlYTIMZYAhMYBO2lDzj';//2NZ0ITWYO5Tc2MAUTIT2zkT2E2iIN4N3EkxYG0MNDVYYjlmx
$time = time();
$post_data = array(
    'access_key_id' => $access_key_id,
    'timestamp'     => $time,
);
ksort($post_data);

$signature_str = http_build_query($post_data, '', '&', PHP_QUERY_RFC3986);
$signature = md5($signature_str . '&access_key_secret=' . $access_key_secret);

$post_data['signature'] = $signature;

/*************************发送请求的各种法师****************************/


//$client = new \GuzzleHttp\Client();
/*发送json方式1*/
//$post_json = json_encode($post_data, JSON_UNESCAPED_UNICODE);
//$response = $client->request('post', 'http://adi-fr.dev/v1/gettime', ['body' => $post_json]);

/*发送arr方式2*/
//$response = $client->request('post', 'http://adi-fr.dev/v1/gettime', [
//    'json' => $post_data
//]);
//
/***********************************************************************/


$client = new \GuzzleHttp\Client(['base_uri' => 'http://adi-fr.dev/v1/']);
$response = $client->request('POST', 'gettime');
$response = $client->request('post', 'http://adi-fr.dev/v1/gettime', [
    'json' => $post_data
]);
$body = $response->getBody();
echo $body->getContents();
