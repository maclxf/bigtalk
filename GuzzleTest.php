<?php
require_once __DIR__ . '/vendor/autoload.php';
use GuzzleHttp\Client;

$client = new \GuzzleHttp\Client();
$res = $client->request('GET', 'https://api.github.com/repos/guzzle/guzzle');
echo $res->getStatusCode();
