<?php

require_once '../../Factory/QueueFactory.php';
use PhpAmqpLib\Message\AMQPMessage;

// 创建一个连接
$factory = new QueueFactory();
$connection = $factory->get();

// 从连接获取通道
$channel = $connection->channel();

// 创建队列声明
$channel->queue_declare('work_queue',false,false,false,false);

for ($i=0; $i <= 50; $i++) { 
    $data = ' [x] Sent message' . $i;
    echo $data , "\n";
    $msg = new AMQPMessage($data);
    $channel->basic_publish($msg, '', 'work_queue');
}

$channel->close();
$connection->close();



