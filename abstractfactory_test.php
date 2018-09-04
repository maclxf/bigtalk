<?php
require_once __DIR__ . '/vendor/autoload.php';

use AbstractFactory\FruitFactory as AFF;

$nf = new AFF\NorthFruitFactory();

$nfa = $nf->getApple();
$nfa->getFruit();

$nfb = $nf->getBear();
$nfb->getFruit();
