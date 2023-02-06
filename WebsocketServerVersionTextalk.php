<?php
require_once __DIR__ . '/vendor/autoload.php';

$server = new WebSocket\Server();

while ($server->accept()) {
    try {
        $message = $server->receive();
        if ($message == 'ping') {
            echo $message;
            $server->send('pong', 'text', false);
        } else {
            // echo $message . '劳动人民';
            $server->send($message . '劳动人民111', 'text', false);
        }
        // Act on received message
        // Break while loop to stop listening
    } catch (\WebSocket\ConnectionException $e) {
        // Possibly log errors
    }
}
$server->close();

//     //code...
// $server->accept();
// $message = $server->receive();
// $server->text($message . 1111);

// $server->close();