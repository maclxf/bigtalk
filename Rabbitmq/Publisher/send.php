<?php
require_once '../Factory/QueueFactory.php';
use PhpAmqpLib\Message\AMQPMessage;

// 创建一个连接
$factory = new QueueFactory();
$connection = $factory->get();

// 从连接获取通道
$channel = $connection->channel();

// 创建交换机
$channel->exchange_declare('test_publisher', 'fanout', false, false, false);


for ($i=0; $i <= 50; $i++) { 
    $data = ' Sent message' . $i;
    echo $data , "\n";
    $msg = new AMQPMessage($data);
    // 要推送到的交换机
    $channel->basic_publish($msg, 'test_publisher');
}

$channel->close();
$connection->close();



