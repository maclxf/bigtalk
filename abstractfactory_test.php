<?php
require_once __DIR__ . '/vendor/autoload.php';

use AbstractFruitFactory\NorthFruitFactory;
use AbstractFruitFactory\SouthFruitFactory;


$nf = new NorthFruitFactory();

$nfa = $nf->getApple();
$nfa->getFruit();

$nfb = $nf->getBear();
$nfb->getFruit();


$sf = new SouthFruitFactory();

$sfa = $sf->getApple();
$sfa->getFruit();

$sfb = $sf->getBear();
$sfb->getFruit();

