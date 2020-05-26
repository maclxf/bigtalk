<?php
include '../../Factory/ConnectionFactory.php';


$connection = (new ConnectionFactory())->create();

$channel = $connection->channel();

$exchange_name = 'test_fanout_exchange';

$type = 'fanout';

$queue_name = 'test_fanout_queue';

$channel->exchange_declare($exchange_name, $type);

$channel->queue_declare($queue_name, false, true);

$channel->queue_bind($queue_name, $exchange_name);

$channel->basic_consume($queue_name, '', false, false, false, false, function($msg) {
    echo $msg->body . "\n";
});

while($channel->is_consuming()) {
    $channel->wait();
}


$channel->close();
$connection->close();