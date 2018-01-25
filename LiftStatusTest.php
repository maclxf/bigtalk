<?php
require_once __DIR__ . '/vendor/autoload.php';

// 状态模式电梯实现
use liftstatustest\Context;
use liftstatustest\OpenningStatus;
use liftstatustest\ClosingStatus;
use liftstatustest\RunningStatus;
use liftstatustest\StoppingStatus;

// 默认的上下文类
$context = new Context();
// 设置上下文类持有关闭状态
$context->setLiftStatus(new ClosingStatus());

$context->open();
$context->close();
$context->run();
$context->stop();

// context与LiftStatus下的多个实际状态实例是聚合关系context owns LiftStatus(openning....),聚合具体表现为整体和部分的关系，部分离开整体后还是可以单独存在