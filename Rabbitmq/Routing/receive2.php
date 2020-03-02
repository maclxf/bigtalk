<?php
require_once '../Factory/QueueFactory.php';
use PhpAmqpLib\Message\AMQPMessage;

$factory = new QueueFactory();
$connection = $factory->get();
$channel = $connection->channel();

// 创建交换机
$channel->exchange_declare('logExchange', 'direct', false, false, false);
// 创建队列
$channel->queue_declare('logDirect2', false, false, false, false);

//绑定队列
$channel->queue_bind('logDirect2', 'logExchange', 'error');
$channel->queue_bind('logDirect2', 'logExchange', 'info');
$channel->queue_bind('logDirect2', 'logExchange', 'warn');

echo " [*] Waiting LogDirect2 for messages. To exit press CTRL+C\n";


$channel->basic_consume('logDirect2', '', false, true, false, false, function ($msg) {
    echo ' [1] ', $msg->body, "\n";
});

while ($channel->is_consuming()) {
    $channel->wait();
}


$channel->close();
$connection->close();