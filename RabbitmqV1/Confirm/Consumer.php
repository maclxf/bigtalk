<?php
include '../Factory/ConnectionFactory.php';

use PhpAmqpLib\Message\AMQPMessage;

$connection = (new ConnectionFactory())->create();

$channel = $connection->channel();

$exchange_name = 'test_confirm_exchange';
$type = 'topic';
$routing_key = 'confirm.#';
$queue_name = 'test_confirm_queue';

$channel->exchange_declare($exchange_name, $type, false, true);

$channel->queue_declare($queue_name, false, true);

$channel->queue_bind($queue_name, $exchange_name, $routing_key);

$channel->basic_consume($queue_name, '', false, true, false, false, function ($msg) {
    echo $msg->body . "\n";
    sleep(3);
});

while ($channel->is_consuming()) {
    $channel->wait();
}

$channel->close();
$connection->close();
