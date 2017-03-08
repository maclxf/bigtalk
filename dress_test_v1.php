<?php

include_once('dress_v1/Person.php');
include_once('dress_v1/DressA_v1.php');
include_once('dress_v1/DressB_v1.php');

$person = new Person();
$person->name('笑帅');

$th = new DressA_v1();
$th->setcomponent($person);
$th->set_color('蓝色');

$dk = new DressB_v1();
$dk->setcomponent($th);
$dk->set_style('嘻哈');
$dk->show();
