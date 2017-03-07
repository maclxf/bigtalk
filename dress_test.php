<?php
	include_once('dress/Concretecomponent.php');
	include_once('dress/DressA.php');
	include_once('dress/DressB.php');


	$person = new Concretecomponent(); // 我是一个具体的人的类对象 我的operation = 我穿的是
	$dressa = new DressA(); // 我有个dress的父类 可以setcomponent 也有operation 当component设置了就直接调用这个component的operation执行
	$dressb = new DressB(); // 同上

	$dressa->setcomponent($person);
	$dressb->setcomponent($dressa);
	$dressb->operation();


