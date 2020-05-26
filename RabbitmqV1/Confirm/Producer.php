<?php
include '../Factory/ConnectionFactory.php';

use PhpAmqpLib\Message\AMQPMessage;

$connection = (new ConnectionFactory())->create();

$channel = $connection->channel();

$channel->set_ack_handler(function (AMQPMessage $message) {
    echo 'Confirm Done';
});

$channel->set_nack_handler(function (AMQPMessage $message) {
    echo 'Confirm failed';
});
// 这个还必须在前面表示设置确认模式
$channel->confirm_select();

$exchange_name = 'test_confirm_exchange';
$routing_key = 'confirm.ack';

$msg = new AMQPMessage('Hello Confirm!!!');
$channel->basic_publish($msg, $exchange_name, $routing_key);


$channel->wait_for_pending_acks();
