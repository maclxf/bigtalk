<?php
require_once '../../Factory/QueueFactory.php';
use PhpAmqpLib\Message\AMQPMessage;

$factory = new QueueFactory();
$connection = $factory->get();
$channel = $connection->channel();

$channel->queue_declare('tx_transaction', false,false,false,false);

$channel->basic_consume('tx_transaction', '', false, true, false, false, function($msg) {
    //$x = 1/0;
    echo ' [x] Received ', $msg->body, "\n";
});

// 消费者是否还在接收？？
while ($channel->is_consuming()) {
    $channel->wait();
}

$channel->close();
$connection->close();
