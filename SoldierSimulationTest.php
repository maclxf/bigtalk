<?php
require_once __DIR__ . '/vendor/autoload.php';

use SoldierSimulation\Soldier;
use SoldierSimulation\WarControllerCenter;

$wcc = new WarControllerCenter();

$a = new Soldier('山丘');

$b = new Soldier('牛头');
$c = new Soldier('炼金');

$wcc->add($a);
$wcc->add($b);
$wcc->add($c);

$a->underAttack($wcc);

