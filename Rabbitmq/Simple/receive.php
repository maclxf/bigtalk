<?php

require_once '../Factory/QueueFactory.php';

// 创建一个连接
$factory = new QueueFactory();
$connection = $factory->get();

// 从连接获取通道
$channel = $connection->channel();

// // 创建队列声明
$channel->queue_declare('hello',false,false,false,false);


echo " [*] Waiting for messages. To exit press CTRL+C\n";

// 消费者接收数据
$channel->basic_consume('hello', '', false, true, false, false, function($msg) {
    echo ' [x] Received ', $msg->body, "\n";
});

// 消费者是否还在接收？？
while ($channel->is_consuming()) {
    $channel->wait();
}

$channel->close();
$connection->close();


