<?php
require_once __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;

$invoke_url = 'http://adi-fr.dev/v1/logistics';

//$invoke_url = 'http://www.adiexpress.fr/v1/logistics';

$access_key_id = 'dTYMNWlYZDZjYT0M';
$access_key_secret = 'JYOjljTiZhTNTNhkzNAWNgN2yZTAFzW2YmMhTkYZZDYZzjBN';
$time = time();


/*access_key_id=dTYMNWlYZDZjYT0M&params%5Bnu%5D=BT1525256727&params%5Border%5D=asc&timestamp=1529978380&access_key_secret=JYOjljTiZhTNTNhkzNAWNgN2yZTAFzW2YmMhTkYZZDYZzjBN


ee473c19e05f7835110126fee4eaefa4*/




$post_data = array(
    'access_key_id' => $access_key_id,
    'timestamp'     => 1529978380,
    'params'        => [
        'nu' => 'BT1525256727',//BT1525256727,BT1525458956,BT1525298158,BT1525187340,BT1525307542
        'order' => 'asc'
    ]
);
ksort($post_data);

$signature_str = http_build_query($post_data, '', '&', PHP_QUERY_RFC3986);

//echo $signature_str . '&access_key_secret=' . $access_key_secret;

//echo '<br>';
$signature = md5($signature_str . '&access_key_secret=' . $access_key_secret);

//echo $signature;

// 写入日志
/*$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
fwrite($myfile, $signature);
fclose($myfile);
exit;*/

$post_data['signature'] = $signature;

//$post_json = json_encode($post_data, JSON_UNESCAPED_UNICODE);



$client = new \GuzzleHttp\Client();

$response = $client->request('post', $invoke_url, ['json' => $post_data]);
$body = $response->getBody();
echo $body->getContents();