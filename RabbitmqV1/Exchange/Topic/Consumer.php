<?php

include '../../Factory/ConnectionFactory.php';

use PhpAmqpLib\Message\AMQPMessage;

$connection = (new ConnectionFactory())->create();

$channel = $connection->channel();

$exchange_name = 'text_topic_exchange';
$type = 'topic';
$routing_key = 'user.*';
$queue_name = 'text_topic_queue';


$channel->exchange_declare($exchange_name, $type);// 为何不能开启持久化

$channel->queue_declare($queue_name, false, true);

$channel->queue_bind($queue_name, $exchange_name, $routing_key);

$channel->basic_consume($queue_name, '', false, false, false, false, function($msg) {
    echo $msg->body . "\n";
});

while($channel->is_consuming()) {
    $channel->wait();
}

$channel->close();
$connection->close();

