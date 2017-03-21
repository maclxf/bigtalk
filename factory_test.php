<?php

require_once './factory/OpreatorFactory/Factory.php';
require_once './factory/OpreatorFactory/AddFactory.php';
require_once './factory/Opreator/Opreator.php';
require_once './factory/Opreator/AddOpreator.php';

$a = 4;
$b = 2;

$factory =new AddFactory();
$opreator = $factory->OpreatorCreater($a, $b);

echo $opreator->getresult();
