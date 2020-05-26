<?php

include '../../Factory/ConnectionFactory.php';


$connection = (new ConnectionFactory())->create();

$channel = $connection->channel();

$exchange_name = 'test_direct_exchange';
$routing_key = 'test.direct';
$type = 'direct';
$queue_name = 'test_direct_queue';

// 声明 交换机
$channel->exchange_declare($exchange_name, $type);
// 声明 队列
$channel->queue_declare($queue_name, false,true);
// 声明 绑定关系
$channel->queue_bind($queue_name, $exchange_name, $routing_key);

$channel->basic_consume($queue_name, '', false, false, false, false, function($msg) {
    echo ' [x] Received ' . $msg->body . "\n";
});

while($channel->is_consuming()) {
    $channel->wait();
}

$channel->close();
$connection->close();