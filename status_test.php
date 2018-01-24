<?php
require_once __DIR__ . '/vendor/autoload.php';
use statuspattern\Context;
use statuspattern\StatusWaitSupervisor;
/*
返还到
'refund_to' => 1,余额 2，支付宝
状态
'status' => 0，等待主管审核，10等待财务审核，11 审核通过，2不通过
*/



$refund = array(
	'refund_to' => 1,
	'status' => 2
);

$new_status = 2;

$context = new Context(new StatusWaitSupervisor());
$context->set_refund($refund);
echo $context->do_request($new_status);

// 状态模式
// status状态类
// 各种状态类继承或者实现与接口
// context 上下文类
//
// 客户端主要操作上下文类
// 对实例化对象时，设置子类为上下文类的属性，然后调用上下文类的公共方法，在公共方法中调用子类的统一方法，并将上下文的对象作为参数传给子类的统一方法
// 在子类的统一方法中
// 通过对上下文对象的状态判断决定是否执行该子类的具体代码，如果状态不是执行该上下类的代码，那么用合适的子类作为参数重新实例化一个上下文类，在来执行
//
//
// 在退款这个流程中子类共有的属性
// 1. 执行成功 / 失败的语句
// 2. 权限判断
// 3.

// 状态模式适用的情况
// 1. 一个对象的行为是由状态时刻改变而改变的
// 2. 状态模式将每一个状态或者条件分支放入一个类