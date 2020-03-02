<?php

require_once '../Factory/QueueFactory.php';

// 创建一个连接
$factory = new QueueFactory();
$connection = $factory->get();

// 从连接获取通道
$channel = $connection->channel();

// // 创建交换机声明
$channel->exchange_declare('test_publisher', 'fanout',false,false,false);

list($queue_name, ,) = $channel->queue_declare("test_publisher_queue", false, false, true, false);


$channel->queue_bind($queue_name, 'test_publisher');

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
    echo ' [1] ', $msg->body, "\n";
};

$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

while ($channel->is_consuming()) {
    $channel->wait();
}


$channel->close();
$connection->close();