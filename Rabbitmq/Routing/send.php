<?php
require_once '../Factory/QueueFactory.php';
use PhpAmqpLib\Message\AMQPMessage;

$factory = new QueueFactory();
$connection = $factory->get();
$channel = $connection->channel();

// 创建交换机
$channel->exchange_declare('logExchange', 'direct', false, false, false);


$type = 'info';
// 创建信息
$msg = new AMQPMessage('我是direct发送的' . $type);


$channel->basic_publish($msg, 'logExchange', $type);


$channel->close();
$connection->close();