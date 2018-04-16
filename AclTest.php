<?php
require_once __DIR__ . '/vendor/autoload.php';

use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

$acl = new Acl();
$guest = new Role('guest');

$acl->addRole($guest);
$resource = new Resource('blog');

// 使用 allow 方法赋权
$acl->allow($guest, $resource, 'view');
if ($acl->hasResource($resource)) {
    var_dump($acl->isAllowed('guest', 'blog', 'read'));
}
exit;

/*$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->set('name','hello,redis');
echo $redis->get('name');
echo '<br>';
var_dump($redis);*/
//echo $acl->isAllowed('guest', 'blog', 'read');
//echo $acl->isAllowed('guest', 'blog', 'write');

//$resource = new Resource('blog');
//$acl->addResource($resource);