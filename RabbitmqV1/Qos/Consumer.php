<?php
require_once '../Factory/ConnectionFactory.php';

use PhpAmqpLib\Message\AMQPMessage;

// 1. 创建链接
$connection = (new ConnectionFactory())->create();

// 2. 创建渠道
$channel = $connection->channel();


$exchange_name = 'test_qos_exchange';
$type = 'topic';
$routing_key = 'qos.#';
$queue_name = 'test_qos_queue';

$channel->exchange_declare($exchange_name, $type, false, true);
$channel->queue_declare($queue_name);
$channel->queue_bind($queue_name, $exchange_name, $routing_key);



$channel->basic_qos(0, 1, false);

$channel->basic_consume($queue_name, '', false, false, false, false, function($msg) use($channel) {
    echo $msg->body . "\n";    
    $channel->basic_ack('2', false);
});


// 消费者是否还在接收？？
while ($channel->is_consuming()) {
    $channel->wait();
}

$channel->close();
$connection->close();