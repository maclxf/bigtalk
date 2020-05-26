<?php
include '../Factory/ConnectionFactory.php';

use PhpAmqpLib\Message\AMQPMessage;

$connection = (new ConnectionFactory())->create();

$channel = $connection->channel();


$exchange_name = 'test_return_exchange';
$routing_key = 'return.#';
$type = 'topic';
$queue_name = 'test_return_queue';

$channel->exchange_declare($exchange_name, $type, false, true);
$channel->queue_declare($queue_name, false, true, false);
$channel->queue_bind($queue_name, $exchange_name, $routing_key);

$channel->basic_consume($queue_name, '', false, false, false, false, function($msg) {
    echo "Receive[x]:" . $msg->body . "\n";
});

while($channel->is_consuming()) {
    echo $channel->wait();
}


$channel->close();
$connection->close();

