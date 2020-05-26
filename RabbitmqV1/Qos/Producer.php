<?php
require_once '../Factory/ConnectionFactory.php';

use PhpAmqpLib\Message\AMQPMessage;

// 1. 创建链接
$connection = (new ConnectionFactory())->create();

// 2. 创建渠道
$channel = $connection->channel();


$exchange_name = 'test_qos_exchange';
$routing_key = 'qos.save';


$msg = new AMQPMessage('Hello Qos!');

for ($i=0; $i < 5; $i++) { 
    $channel->basic_publish($msg, $exchange_name, $routing_key, false);
}


$channel->close();
$connection->close();