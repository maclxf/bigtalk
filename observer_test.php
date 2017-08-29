<?php
require_once __DIR__ . '/vendor/autoload.php';
// 1. 实现观察者类
// 2. 希望看到composer的自动加载
// 依赖注入

use observer\concretesubject;
use observer\concreteobserver;

// 通知人
$tongzhi1 = new Concretesubject('前台张小娴');

// 观察者
$guancha1 = new Concreteobserver('程序员小高', $tongzhi1);
$guancha2 = new Concreteobserver('销售小红', $tongzhi1);

//给观察者说等哈要通知我
$tongzhi1->add_observer($guancha1);
$tongzhi1->add_observer($guancha2);

$tongzhi1->del_observer($guancha1);

$tongzhi1->subjectstatus = 1;

// 通知每个人
$tongzhi1->notify();





