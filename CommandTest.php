<?php
require_once __DIR__ . '/vendor/autoload.php';

use command\Invoker;
use command\AddRequiredCommand;
use command\AddPageCommand;


$boss = new Invoker();
$boss->set_commander(new AddRequiredCommand());
$boss->action();

$boss->set_commander(new AddPageCommand());
$boss->action();
