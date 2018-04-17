<?php
require_once __DIR__ . '/vendor/autoload.php';

use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole as Role;
use Zend\Permissions\Acl\Resource\GenericResource as Resource;

$acl = new Acl();

$guest = new Role('guest');
$acl->addRole($guest);

$resource = new Resource('blog');
if (!$acl->hasResource($resource)) {
    $acl->addResource($resource);
}

// 使用 allow 方法
// 给guest赋与blog的view的权限
// 当blog是null时表示对所有资源都有view的权限
echo '<pre>';
$acl->allow($guest, $resource, 'read');
echo 'guest can read';
var_dump($acl->isAllowed($guest, $resource, 'read'));
echo '<hr>';



$editor = new Role('editor');
// 把guest的权限全部赋予editor
$acl->addRole($editor, $guest);
$acl->allow($editor, $resource, 'write');
echo 'guest can read ';
var_dump($acl->isAllowed($guest, $resource, 'read'));
echo 'guest can not write ';
var_dump($acl->isAllowed($guest, $resource, 'write'));
echo 'editor can read ';
var_dump($acl->isAllowed($editor, $resource, 'read'));
echo 'editor can write ';
var_dump($acl->isAllowed($editor, $resource, 'write'));
echo '<hr>';



$reviewer = new Role('reviewer');
$acl->addRole($reviewer, $guest);
$acl->allow($reviewer, $resource, 'moderate');
echo 'reviewer can read ';
var_dump($acl->isAllowed($reviewer, $resource, 'read'));
echo 'reviewer can moderate ';
var_dump($acl->isAllowed($reviewer, $resource, 'moderate'));
echo 'reviewer can not write ';
var_dump($acl->isAllowed($reviewer, $resource, 'write'));
echo '<hr>';


// 把guest和editor,reviewer的权限全部给admin
$admin = new Role('admin');
$acl->addRole($admin, [$guest, $editor, $reviewer]);
$acl->allow($admin, $resource, 'settings');
echo 'admin can read ';
var_dump($acl->isAllowed($admin, $resource, 'read'));
echo 'admin can moderate ';
var_dump($acl->isAllowed($admin, $resource, 'moderate'));
echo 'admin can write ';
var_dump($acl->isAllowed($admin, $resource, 'write'));
echo 'admin can settings ';
var_dump($acl->isAllowed($admin, $resource, 'settings'));
echo '<hr>';

$news_resource = new Resource('news');
// 资源和角色的操作一样，把已有的权限全部赋予给新的资源
// 把blog拥有角色的权限赋给news
$acl->addResource($news_resource, $resource);
echo 'guest can read_news ';
var_dump($acl->isAllowed($guest, $news_resource, 'read'));
echo 'guest can not write_news ';
var_dump($acl->isAllowed($guest, $news_resource, 'write'));
echo 'editor can read_news ';
var_dump($acl->isAllowed($editor, $news_resource, 'read'));
echo 'editor can write_news ';
var_dump($acl->isAllowed($editor, $news_resource, 'write'));
echo '<hr>';
echo 'reviewer can read_news ';
var_dump($acl->isAllowed($reviewer, $news_resource, 'read'));
echo 'reviewer can moderate_news ';
var_dump($acl->isAllowed($reviewer, $news_resource, 'moderate'));
echo 'reviewer can not write_news ';
var_dump($acl->isAllowed($reviewer, $news_resource, 'write'));
echo '<hr>';
echo 'admin can read_news ';
var_dump($acl->isAllowed($admin, $news_resource, 'read'));
echo 'admin can moderate_news ';
var_dump($acl->isAllowed($admin, $news_resource, 'moderate'));
echo 'admin can write_news ';
var_dump($acl->isAllowed($admin, $news_resource, 'write'));
echo 'admin can settings_news ';
var_dump($acl->isAllowed($admin, $news_resource, 'settings'));



$acl->addResource('dashboard');
$acl->addResource('homepage');
$acl->allow(
    [$reviewer, $editor],
    ['dashboard', 'homepage'],
    ['write', 'maintenance']
);

echo '<hr>';
echo 'reviewer can write_dashboard ';
var_dump($acl->isAllowed($reviewer, 'dashboard', 'write'));
echo 'reviewer can maintenance_dashboard ';
var_dump($acl->isAllowed($reviewer, 'dashboard', 'maintenance'));
echo 'reviewer can write_homepage ';
var_dump($acl->isAllowed($reviewer, 'homepage', 'write'));
echo 'reviewer can maintenance_homepage ';
var_dump($acl->isAllowed($reviewer, 'homepage', 'maintenance'));

echo 'editor can write_dashboard ';
var_dump($acl->isAllowed($editor, 'dashboard', 'write'));
echo 'editor can maintenance_dashboard ';
var_dump($acl->isAllowed($editor, 'dashboard', 'maintenance'));
echo 'editor can write_homepage ';
var_dump($acl->isAllowed($editor, 'homepage', 'write'));
echo 'editor can maintenance_homepage ';
var_dump($acl->isAllowed($editor, 'homepage', 'maintenance'));
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