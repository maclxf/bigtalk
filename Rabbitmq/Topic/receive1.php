<?php
require_once '../Factory/QueueFactory.php';

$factory = new QueueFactory();
$connection = $factory->get();
$channel = $connection->channel();

$channel->exchange_declare('topicExchange', 'topic', false, false, false);

$channel->queue_declare('topicQueue1',false, false, true, false);

$channel->queue_bind('topicQueue1', 'topicExchange', 'goods.add');
echo " [*] Waiting topicQueue1 for messages. To exit press CTRL+C\n";

$channel->basic_consume('topicQueue1', '', false, true, false, false, function ($msg) {
    echo ' [1] ', $msg->body, "\n";
});

while ($channel->is_consuming()) {  
    $channel->wait();
}

$channel->close();
$connection->close();




