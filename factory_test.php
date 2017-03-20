<?php

require_once 'factory/OpreatorFactory/AddFactory.php';

$a = 1;
$b = 2;

$factory =new AddFactory();
$opreator = $factory->OpreatorCreater($a, $b);

echo $opreator->getresult();
