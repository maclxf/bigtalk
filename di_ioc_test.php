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