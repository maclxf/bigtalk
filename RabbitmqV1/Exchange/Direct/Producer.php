<?php
include '../../Factory/ConnectionFactory.php';

use PhpAmqpLib\Message\AMQPMessage;


$connection = (new ConnectionFactory())->create();

$channel = $connection->channel();

$exchange_name = 'test_direct_exchange';
$routing_key = 'test.direct';

$msg = new AMQPMessage("This message from exchange which {$exchange_name} routing key is {$routing_key}");
$channel->basic_publish($msg, $exchange_name, $routing_key);

$channel->close();
$connection->close();
