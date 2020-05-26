<?php

include '../../Factory/ConnectionFactory.php';

use PhpAmqpLib\Message\AMQPMessage;

$connection = (new ConnectionFactory())->create();

$channel = $connection->channel();


$exchange_name = 'text_topic_exchange';
//$type = 'topic';//为何不在次指定type呢？？
$routing_key_add = 'user.add';
$routing_key_update = 'user.update';
$routing_key_del = 'user.del.abc';


$msg = new AMQPMessage("This message from exchange which {$exchange_name} routing key is {$routing_key_add}");
$channel->basic_publish($msg, $exchange_name, $routing_key_add);
$msg = new AMQPMessage("This message from exchange which {$exchange_name} routing key is {$routing_key_update}");
$channel->basic_publish($msg, $exchange_name, $routing_key_update);
$msg = new AMQPMessage("This message from exchange which {$exchange_name} routing key is {$routing_key_del}");
$channel->basic_publish($msg, $exchange_name, $routing_key_del);

$channel->close();
$connection->close();