<?php
require_once __DIR__ . '/vendor/autoload.php';

use HardP\Gamer;

$proxyer = new Gamer('小军长');

$proxyer->login('xjz', 'ps6666');
echo '<br>';
$proxyer->killenemy();
echo '<br>';
$proxyer->upgrade();