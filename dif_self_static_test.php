<?php

require_once ('dif_self_static/TaxiStatic.php');
require_once ('dif_self_static/TaxiSelf.php');


$taxi = new TaxiStatic();
echo '这是调用static的例子：<br>';
echo $taxi->model();

echo '<br>';

$taxi = new TaxiSelf();
echo '这是调用self的例子：<br>';
echo $taxi->model();