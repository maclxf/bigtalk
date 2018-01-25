<?php
require_once __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;

$client = new \GuzzleHttp\Client();
$order_no = '810561975159';
//$res = $client->request('GET', 'https://api.github.com/repos/guzzle/guzzle');
//echo $res->getStatusCode();
$arr = [
    'query' => [
        'key_id' => 'kuai',
        'secret_key' => '123456789',
        'order_no' => $order_no,
        'order_by' => 'DESC'
    ],

];

$res = $client->request('GET', 'http://adi-fr.dev/api', $arr);

echo '<pre>';
var_dump($res);
