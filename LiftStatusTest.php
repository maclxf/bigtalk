<?php
require_once __DIR__ . '/vendor/autoload.php';

// 状态模式电梯实现
use liftstatustest\Context;
use liftstatustest\OpenningStatus;
use liftstatustest\ClosingStatus;
use liftstatustest\RunningStatus;
use liftstatustest\StoppingStatus;


$context = new Context();
$context->setLiftStatus(new ClosingStatus());

$context->open();
$context->close();
$context->run();
$context->stop();
