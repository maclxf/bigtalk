<?php
require_once './factory/OpreatorFactory/AddFactory.php';
// 加载文件的顺序是对实例化对象或者调用方法是有影响的
// 应当按照程序调用顺序来
$a = 19;
$b = 2;

$factory =new AddFactory();
$opreator = $factory->OpreatorCreater($a, $b);

echo $opreator->getresult();

