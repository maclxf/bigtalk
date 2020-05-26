<?php
include '../../Factory/ConnectionFactory.php';

use PhpAmqpLib\Message\AMQPMessage;

$connection = (new ConnectionFactory())->create();

$channel = $connection->channel();

$exhange_name = 'test_fanout_exchange';



for ($i = 0; $i < 10; $i++) { 
    $msg = new AMQPMessage("Hello Fanout{$i} Exchange \n");
    $channel->basic_publish($msg, $exhange_name, 'asdf');
}


$channel->close();
$connection->close();

