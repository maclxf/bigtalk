<?php

require_once '../../Factory/QueueFactory.php';

// 创建一个连接
$factory = new QueueFactory();
$connection = $factory->get();

// 从连接获取通道
$channel = $connection->channel();

// // 创建队列声明
$channel->queue_declare('work_queue',false,false,false,false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$channel->basic_consume('work_queue', '', false, true, false, false, function ($msg) {
    echo ' [x] Received ', $msg->body, "\n";
    sleep(1);
    echo " [x] Done\n";
});

while ($channel->is_consuming()) {
    $channel->wait();
}

$channel->close();
$connection->close();