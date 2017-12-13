<?php
// 必须引入的包含
require_once __DIR__ . '/vendor/autoload.php';

use di_ioc\Container;

use di_ioc\Foo;
use di_ioc\Boo;
use di_ioc\Bim;

$co = new Container();
$co->bim = function() {
    return new Bim();
};

$co->boo = function($co) {
    return new Boo($co->bim);
};

$co->foo = function($co) {
    return new Foo($co->boo);
};

$foo = $co->foo;
$foo->do_anything();

echo '<hr>';


use di_ioc\Component;
use di_ioc\DI;

use di_ioc\A;
use di_ioc\B;



$di = new Di();

$di->set('a', function (){
    return new A();
});

$di->set('b', function (){
    return new B();
});

$com = new Component($di);

$com->task();
$com->other_task();