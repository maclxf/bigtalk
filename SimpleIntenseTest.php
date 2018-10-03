<?php
require_once __DIR__ . '/vendor/autoload.php';
use SimpleIntense\SimpleIntense;
error_reporting(E_ALL);
$si1 = SimpleIntense::getInstance('big');
$si1->getName();

echo '<hr>';

$si2 = SimpleIntense::getInstance('small');
$si2->getName();
