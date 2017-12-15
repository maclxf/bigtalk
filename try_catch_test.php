<?php
require_once('try_catch.php');

$user = new UserController();
var_dump($user->login('l1xf', '123456'));