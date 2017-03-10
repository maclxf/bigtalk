<?php

include_once('dress_v1/Person.php');
include_once('dress_v1/DressA_v1.php');
include_once('dress_v1/DressB_v1.php');

// 先要一个 需要 装饰的对象
$person = new Person();
$person->name('笑帅');

// 把这个需要装饰的对象拿来做具体的装饰
$th = new DressA_v1();
$th->setcomponent($person);
$th->set_color('蓝色');

// 把这个需要装饰的对象拿来做具体的装饰
$dk = new DressB_v1();
$dk->setcomponent($th);
$dk->set_style('嘻哈');
$dk->show();

