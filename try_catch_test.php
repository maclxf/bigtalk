<?php
require_once('try_catch.php');

$user = new UserController();
var_dump($user->login('lxf', '123456'));