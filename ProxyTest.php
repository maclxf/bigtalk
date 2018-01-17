<?php
require_once __DIR__ . '/vendor/autoload.php';

use SoftProxy\ProxyGamer;

$proxyer = new SoftProxy\ProxyGamer('小军长');

$proxyer->login('xjz', 'ps6666');
echo '<br>';
$proxyer->killenemy();
echo '<br>';
$proxyer->upgrade();