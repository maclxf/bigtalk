<?php
require_once __DIR__ . './../../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;

class ConnectionFactory {

    public function create():AMQPStreamConnection {
        return new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
    }
}