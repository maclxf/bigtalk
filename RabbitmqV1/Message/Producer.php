<?php
include '../Factory/ConnectionFactory.php';

use PhpAmqpLib\Message\AMQPMessage;

$connection = (new ConnectionFactory())->create();

$channel = $connection->channel();

$msg = new AMQPMessage('hello message!', [
    // 'application_headers' => new stdClass([
    //     'header_1' => 'kkk',
    //     'header_2' => 'bbb'
    // ]),//TODO::设置了不知道如何适用
    'expiration' => 10000

]);

for ($i=0; $i < 10; $i++) { 
    $channel->basic_publish($msg, '', 'test001');
}

$channel->close();
$connection->close();
