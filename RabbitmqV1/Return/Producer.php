<?php
/**
 * Can not use
 * Sorry
 */
include '../Factory/ConnectionFactory.php';

use PhpAmqpLib\Message\AMQPMessage;

$connection = (new ConnectionFactory())->create();

$channel = $connection->channel();

$channel->set_return_listener(function ($reply_code,$reply_text,$exchange,$routing_key,$message) {
    var_dump($reply_code);
});

$exchange_name = 'test_return_exchange';
$routing_key = 'return.save';
$routing_key_error = 'abc.save';


$msg = new AMQPMessage('Hello return!!');
$channel->basic_publish($msg, $exchange_name, $routing_key_error, true);

// $channel->close();
// $connection->close();
