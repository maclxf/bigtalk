<?php
require_once __DIR__ . '/vendor/autoload.php';

use Zend\Permissions\Rbac\Rbac;
use Zend\Permissions\Rbac\RoleInterface;

class MyRole implements RoleInterface
{
    // .. implementation
}

// Creating roles manually
$foo  = new MyRole('foo');

$rbac = new Rbac();
$rbac->addRole($foo);

var_dump($rbac->hasRole('foo')); // true