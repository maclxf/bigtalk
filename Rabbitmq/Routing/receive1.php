<?php
require_once '../Factory/QueueFactory.php';

$factory = new QueueFactory();
$connection = $factory->get();
$channel = $connection->channel();

// 创建交换机
$channel->exchange_declare('logExchange', 'direct', false, false, false);
// 创建队列
$channel->queue_declare('logDirect1', false, false, false, false);

//绑定队列
$channel->queue_bind('logDirect1', 'logExchange', 'error');
echo " [*] Waiting LogDirect1 for messages. To exit press CTRL+C\n";


$channel->basic_consume('logDirect1', '', false, true, false, false, function ($msg) {
    echo ' [1] ', $msg->body, "\n";
});

while ($channel->is_consuming()) {
    $channel->wait();
}


$channel->close();
$connection->close();