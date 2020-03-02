<?php
require_once __DIR__ . './../../vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;

class QueueFactory {
    public function get():AMQPStreamConnection {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');

        return $connection;
    }
}
