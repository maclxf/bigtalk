<?php
require_once __DIR__ . '/vendor/autoload.php';

use Bridge\HouseCorp;
use Bridge\ClotheCorp;
use Bridge\HouseProd;
use Bridge\ClotheProd;

$h = new HouseCorp(new HouseProd());
$h->makeMoney();

$c = new ClotheCorp(new ClotheProd());
$c->makeMoney();