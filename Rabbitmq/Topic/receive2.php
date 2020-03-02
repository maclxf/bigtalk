<?php
require_once '../Factory/QueueFactory.php';

$factory = new QueueFactory();
$connection = $factory->get();
$channel = $connection->channel();


$channel->exchange_declare('topicExchange', 'topic', false, false, false);

$channel->queue_declare('topicQueue2',false, false, true, false);

$channel->queue_bind('topicQueue2', 'topicExchange', 'goods.#');
echo " [*] Waiting topicQueue2 for messages. To exit press CTRL+C\n";

$channel->basic_consume('topicQueue2', '', false, true, false, false, function ($msg) {
    echo ' [2] ', $msg->body, "\n";
});

while ($channel->is_consuming()) {
    $channel->wait();
}

$channel->close();
$connection->close();




