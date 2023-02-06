<?php
require_once __DIR__ . '/vendor/autoload.php';
//外观模式
//require_once('facade/Facade.php');

//导入一个类后可以使用非限定命名空间来访问类
use Facade\Facade;
$facade = new Facade();

// 否则就要限定命名空间
/*use Facade;
$facade = new Facade\Facade();*/

$facade->shoot();

echo '<br>';
$facade->run();