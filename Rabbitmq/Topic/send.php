<?php
require_once '../Factory/QueueFactory.php';
use PhpAmqpLib\Message\AMQPMessage;

$factory = new QueueFactory();
$connection = $factory->get();
$channel = $connection->channel();

$channel->exchange_declare('topicExchange', 'topic', false, false, false);

$routeingKey = 'goods.del';
$msg = new AMQPMessage('我是 topic ' . $routeingKey);
$channel->basic_publish($msg, 'topicExchange', $routeingKey);
echo 'start send ...';

$channel->close();
$connection->close();