<?php
include '../Factory/ConnectionFactory.php';

use PhpAmqpLib\Message\AMQPMessage;

$connection = (new ConnectionFactory())->create();

$channel = $connection->channel();

$channel->basic_consume('test001', '', false, false, false, false, function($msg) {
    echo $msg->body . "\n";
});

while($channel->is_consuming()) {
    $channel->wait();
}


$channel->close();
$connection->close();