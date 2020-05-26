<?php
require_once '../Factory/ConnectionFactory.php';

use PhpAmqpLib\Message\AMQPMessage;

// 1. 创建链接
$connection = (new ConnectionFactory())->create();

// 2. 创建渠道
$channel = $connection->channel();


// 3. 声明队列
// string $queue = ''                    队列
// bool $passive = false                 //被动的？？？
// bool $durable = false                是否持久化
// bool $exclusive = false              是否独占用于顺序消费的场景，标识只有该 链接 能处理 ？？
// bool $auto_delete = true             当没有和交互机绑定时 会自动删除
// bool $nowait = false                 // ？？
// array|\PhpAmqpLib\Wire\AMQPTable $arguments = array() //？？
// int|null $ticket = null              //？
$queue_name = 'test001';
$channel->queue_declare($queue_name, false, true, false, false);

// string $queue = ''                //队列名称
// string $consumer_tag = ''         //？？
// bool $no_local = false            // ？？
// bool $no_ack = false             // 不要自动回复
// bool $exclusive = false          // 独占
// bool $nowait = false            // ？？
// callable|null $callback = null  // 回调函数
// int|null $ticket = null
// array $arguments = array()
$channel->basic_consume($queue_name, '', false, false, false, false, function ($msg) {
    echo ' [x] Received ' . $msg->body . "\n";
});

// 消费者是否还在接收？？
while ($channel->is_consuming()) {
    $channel->wait();
}

$channel->close();
$connection->close();
