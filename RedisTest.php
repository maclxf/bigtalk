<?php
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->set('name','hello,redis');
echo $redis->get('name');
echo '<br>';
var_dump($redis);