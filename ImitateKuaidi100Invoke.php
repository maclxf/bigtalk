<?php
require_once __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;

$invoke_url = 'http://adi-fr.dev/v1/kuaidi100';

$access_key_id = 'dTYMNWlYZDZjYT0M';//'RYTmzTBYjjNlZ3xZ';//zMQGzU54NTZWmjzV
$access_key_secret = 'JYOjljTiZhTNTNhkzNAWNgN2yZTAFzW2YmMhTkYZZDYZzjBN';//'MNTBdNEOE2yZNNDRjZgYTMj0MOYxzhlYTIMZYAhMYBO2lDzj';//2NZ0ITWYO5Tc2MAUTIT2zkT2E2iIN4N3EkxYG0MNDVYYjlmx
$time = time();


$post_data = array(
    'access_key_id' => $access_key_id,
    'timestamp'     => $time,
    'params'        => [
        'nu' => 'BT1525057249',//BT1524867441,BT1525062675,BT1525063168
        'order' => 'asc'
    ]
);
ksort($post_data);

$signature_str = http_build_query($post_data, '', '&', PHP_QUERY_RFC3986);
$signature = md5($signature_str . '&access_key_secret=' . $access_key_secret);

$post_data['signature'] = $signature;

//$post_json = json_encode($post_data, JSON_UNESCAPED_UNICODE);



$client = new \GuzzleHttp\Client();

$response = $client->request('get', $invoke_url, ['json' => $post_data]);
$body = $response->getBody();
echo $body->getContents();