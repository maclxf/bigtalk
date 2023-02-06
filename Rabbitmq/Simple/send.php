<?php

require_once '../Factory/QueueFactory.php';
use PhpAmqpLib\Message\AMQPMessage;

// 创建一个连接
$factory = new QueueFactory();
$connection = $factory->get();

// 从连接获取通道
$channel = $connection->channel();

// 创建队列声明
//$channel->queue_declare('hello',false,false,false,false);

$msg = new AMQPMessage('Hello Worl1d!');
$channel->basic_publish($msg, '', 'hello');

// $channel->basic_publish();


echo " [x] Sent 'Hello World!'\n";

$channel->close();
$connection->close();



