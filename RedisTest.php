<?php
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
/*
string（字符串） 普通键值对存储，一个键对应一个值。
list（列表）     列表的功能十分独特，他可以在一个键下面存储N个可以重复的元素。其实就是把string类型右边的值换成了多个元素组成的列表。
set（集合）      set集合和list列表十分的相似，都可以存储多个字符串。但是list列表可以存储重复值，而set集合中不可重复。
hash（散列）
zset（有序集合）
*/

/********************string（字符串）***************************/
/*set 设置键的值
get 获取键的值
del 删除值
$redis->set PHP设置值
$redis->get PHP获取值
$redis->delete  PHP删除值*/
echo '<pre>';
//设置name的值为hello,redis
$redis->set('name','hello,redis');
// 获取name的值
var_dump($redis->get('name'));
// 删除name
$redis->delete('name');
/************************************************************/


/********************list（列表）***************************/
/*rpush 从列表的右边添加一个值
lpush   从列表左边添加一个值
rpop    从列表右边删除一个值
lpop    从列表左边删除一个值
lindex  获取列表在给定位置上的一个元素
lrange  获取给定范围所有元素
$redis->rpush   PHP版本从右侧添加一个值
$redis->lrange  PHP版本获取范围内所有的元素
$redis->lindex  PHP版本获取指定索引的值
$redis->lpop    PHP版本从左侧删除一个元素*/
// 往列表中添加一个值
$redis->rpush("list-key","item"); // 从列表右侧添加一个值item
$redis->rpush("list-key","item2"); // 含有2个元素，返回int 2
$r = $redis->rpush("list-key","item3"); // 含有3个元素，返回int 3
var_dump($r);

// lrange该值返回的结果为："item","item2","item"。
var_dump($redis->lrange("list-key", 0 ,-1));

// lindex获取索引为0的值，也就是第二个："item"
$li = $redis->lindex("list-key",0);
var_dump($li);

// lpop从左侧删除了一个元素，成功返回 被删除元素的值
$lp = $redis->lpop("list-key");
var_dump($lp);

var_dump($redis->lrange("list-key", 0 ,-1));

// rpop从右侧删除了一个元素，成功返回 被删除元素的值
$rp = $redis->rpop("list-key");
var_dump($rp);

var_dump($redis->lrange("list-key", 0 ,-1));

$redis->delete("list-key");
/******************************************************************************/


/*$redis->lindex("list-key",1);

var_dump($redis->delete("list-key"));*/