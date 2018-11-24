<?php
require_once __DIR__ . '/vendor/autoload.php';

use DressV2\RunCar;
use DressV2\FlyDecorator;
use DressV2\SwimDecorator;

$car = new RunCar();

$flyCar = new FlyDecorator($car);
$flySwimCar = new SwimDecorator($flyCar);

$flySwimCar->show();