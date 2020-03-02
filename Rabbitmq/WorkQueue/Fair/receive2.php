<?php

require_once '../../Factory/QueueFactory.php';

// 创建一个连接
$factory = new QueueFactory();
$connection = $factory->get();

// 从连接获取通道
$channel = $connection->channel();

// 创建队列声明
$channel->queue_declare('work_queue',false,false,false,false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

//较于round-robin多出来的，含义是什么呢？
$channel->basic_qos(null, 1, null);
//较于round-robin多出来的，含义是什么呢？
$channel->basic_consume('work_queue', '', false, false, false, false, function ($msg) {
    echo ' [x] Received ', $msg->body, "\n";
    sleep(5);
    echo " [x] Done\n";
    //较于round-robin多出来的，含义是什么呢？
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']); 
});

while ($channel->is_consuming()) {
    $channel->wait();
}

$channel->close();
$connection->close();