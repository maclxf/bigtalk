<?php

require_once __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;

$str = '775510197994133';
$isMatched = preg_match_all('/^(268|888|588|688|368|468|568|668|768|868|968)[0-9]{9}$|^(11|22|40|268|888|588|688|368|468|568|668|768|868|968)[0-9]{10}$|^(STO)[0-9]{10}$|^(33)[0-9]{11}$|^(4)[0-9]{12}$|^(55)[0-9]{11}$|^(66)[0-9]{11}$|^(77)[0-9]{13}$|^(88)[0-9]{11}$|^(99)[0-9]{11}$\'/', $str, $matches);
var_dump($isMatched, $matches);
exit;

$url = 'http://www.kuaidi100.com/autonumber/auto?num=%s&key=%s';

$url = sprintf($url, '906919164534', '383e8843862b20a3');
dump($url);

$client = new \GuzzleHttp\Client();
$response = $client->request('get', $url);

$body = $response->getBody();
$ret_json =  $body->getContents();
$ret = json_decode($ret_json);
var_dump($ret);