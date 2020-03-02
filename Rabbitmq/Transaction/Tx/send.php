<?php
require_once '../../Factory/QueueFactory.php';
use PhpAmqpLib\Message\AMQPMessage;

$factory = new QueueFactory();
$connection = $factory->get();
$channel = $connection->channel();

$channel->queue_declare('tx_transaction', false,false,false,false);

$msg = new AMQPMessage('message of tx');

try {
    // 没有在这里捕捉到报错进而进入到下面的catch
    $channel->tx_select();

    $channel->basic_publish($msg, '', 'tx_transaction');
    1/0;
    echo 'sended message of tx';

    $channel->tx_commit();
    
} catch (\Throwable $th) {
    $channel->tx_rollback();
    echo 'send error';
}


$channel->close();
$connection->close();
