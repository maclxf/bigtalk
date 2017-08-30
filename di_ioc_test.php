<?php
require_once('./di_ioc/Container.php');
require_once('./di_ioc/Component.php');
require_once('./di_ioc/Foo.php');
require_once('./di_ioc/Boo.php');
require_once('./di_ioc/Bim.php');

/*use di_ioc\Container;
use di_ioc\Component;

use di_ioc\Foo;
use di_ioc\Boo;
use di_ioc\Bim;*/

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