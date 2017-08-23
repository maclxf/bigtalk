<?php
require_once('trait/Qiaofeng.php');
require_once('trait/Guojing.php');


$qiaofeng = new Qiaofeng();
$qiaofeng->say();
echo '<br>';
$guojing = new Guojing();
$guojing->say();
echo '<br>';
$guojing->strongzhi();