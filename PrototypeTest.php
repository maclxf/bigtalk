<?php
require_once __DIR__ . '/vendor/autoload.php';
use prototype\ConcretePrototype;

class Demo {
    public $string;
}

$demo = new Demo();
$demo->string = 'pato';
$shallow_fir = new ConcretePrototype($demo);
$shallow_sec = $shallow_fir->shallowCopy();
echo '<pre>';
var_dump($shallow_fir->getName());
var_dump($shallow_sec->getName());

$demo->string = "qk";
var_dump($shallow_fir->getName());
var_dump($shallow_sec->getName());

echo '<hr>';
$demo1 = new Demo();
$demo1->string = 'CR7';
$deep_fir = new ConcretePrototype($demo1);
$deep_sec = $deep_fir->deepCopy();
var_dump($deep_fir->getName());
var_dump($deep_sec->getName());

$demo1->string = "m10";
var_dump($deep_fir->getName());
var_dump($deep_sec->getName());