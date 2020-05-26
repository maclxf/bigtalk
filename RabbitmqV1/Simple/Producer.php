<?php
require_once '../Factory/ConnectionFactory.php';

use PhpAmqpLib\Message\AMQPMessage;

// 1. 创建链接
$connection = (new ConnectionFactory())->create();

// 2. 创建渠道
$channel = $connection->channel();

// 3.创建消息
$msg = new AMQPMessage('Hello World!');

//\PhpAmqpLib\Message\AMQPMessage $msg, 要发送的消息
// string $exchange = '' 指定交换机
// string $routing_key = '' //路由key
// bool $mandatory = false  
// bool $immediate = false
// int|null $ticket = null
for ($i=0; $i < 5; $i++) { 
    // 通过channel发送消息，这里交换机 是 空，routing_key 是test001,但是并没指定队列，而消费者监听的确是队列，那是如何保证消息是发送到位了呢？？？
    // 当 excheange 为 空时，会默认适用 amqp default 这个交换机，这个交换机的路由 拿路由去匹配是否有对应的 队列名称 完全匹配就把消息路由过去
    $channel->basic_publish($msg, '', 'test001');
}

$channel->close();
$connection->close();

