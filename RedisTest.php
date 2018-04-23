<?php
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
/*
string（字符串） 普通键值对存储，一个键对应一个值。
list（列表）     列表的功能十分独特，他可以在一个键下面存储N个可以重复的元素。其实就是把string类型右边的值换成了多个元素组成的列表。
set（集合）      set集合和list列表十分的相似，都可以存储多个字符串。但是list列表可以存储重复值，而set集合中不可重复。
hash（散列）     一个散列可以包含多个键值对
                散列的每个键都不能重复，各不相同，无序排列
                其值可以是字符串或数字值
                对于数字值，可以执行自增或者自减操作
zset（有序集合）
*/

/********************string（字符串）***************************/
/*set 设置键的值
get 获取键的值
del 删除值
$redis->set     PHP设置值 设置成功返回true
$redis->get     PHP获取值
$redis->delete  PHP删除值 删除成功返回1*/
echo '<pre>';
//设置name的值为hello,redis
var_dump($redis->set('name','hello,redis'));
// 获取name的值
var_dump($redis->get('name'));
// 删除name
var_dump($redis->delete('name'));
/************************************************************/


/********************list（列表）***************************/
/*rpush 从列表的右边添加一个值
lpush   从列表左边添加一个值
rpop    从列表右边删除一个值
lpop    从列表左边删除一个值
lindex  获取列表在给定位置上的一个元素
lrange  获取给定范围所有元素
$redis->rpush   PHP版本从右侧添加一个值        从列表右侧添加一个值item,含有1个元素，返回int 1，添加一个元素依次递增
$redis->lrange  PHP版本获取范围内所有的元素    返回列表 key 中指定区间内的元素，区间以偏移量 start 和 stop 指定。
$redis->lindex  PHP版本获取指定索引的值        根据索引取值 不存在的话返回false
$redis->lpop    PHP版本从左侧删除一个元素*/
// 往列表中添加一个值
var_dump($redis->rpush("list-key","item")); // 从列表右侧添加一个值item,含有1个元素，返回int 1
var_dump($redis->rpush("list-key","item2")); // 含有2个元素，返回int 2
var_dump($redis->rpush("list-key","item3")); // 含有3个元素，返回int 3

// lrange该值返回的结果为："item","item2","item"。
// 返回列表 key 中指定区间内的元素，区间以偏移量 start 和 stop 指定。
var_dump($redis->lrange("list-key", 0 , -1));

// lindex获取索引为0的值，也就是第二个："item"
$li = $redis->lindex("list-key", 0);
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


/********************set（列表）***************************/
/*sadd    将指定的元素添加到集合
smembers    返回集合所包含的所有元素，如果数据量大， 谨慎使用
sismember   检查给定的元素是否在集合中
srem    如果给定的元素在集合中，则删除它
$redis->sadd    PHP版本将元素添加到集合               成功返回1，失败返回0
$redis->smembers    PHP版本取出集合中的所有元素       返回set-list中的所有
$redis->sismember   PHP版本检测元素是否存在于集合中    返回bool
$redis->srem    PHP版本从集合中删除一个元素*/          //删除成功返回1，否则0
var_dump($redis->sadd('set-list', 'set-item'));// 成功返回1
var_dump($redis->sadd('set-list', 'set-item'));// 失败返回0因为已经添加过了
var_dump($redis->sadd('set-list', 'set-item2'));// 成功返回1



var_dump($redis->smembers('set-list')); // 返回set-list中的所有 set-item, set-item2

var_dump($redis->sismember('set-list', 'set-item1')); // 检查set-list是否有set-item1

var_dump($redis->srem('set-list', 'set-item'));// 从集合中删除一个元素，删除成功返回1，否则0

var_dump($redis->smembers('set-list'));

$redis->delete("set-list");
/*$redis->lindex("list-key",1);

var_dump($redis->delete("list-key"));*/
/********************hash（列表）***************************/
/*
hset    将指定的元素添加到散列
hget    获取指定的键的值
hgetall 获取散列所有的键值对
hdel    删除给定键
$redis->hset    PHP版本，添加元素到散列
$redis->hget    PHP版本，获取指定键的值
$redis->hgetall PHP版本，获取散列所有的键值对
$redis->hdel    PHP版本，删除给定键
*/
//我们先插入一个键值对到hash-key散列。1代表插入成功；0元素代表已经存在
var_dump($redis->hset('hash-key','sub-key1','value1'));// 设置成功返回1，若重复的
var_dump($redis->hset('hash-key','sub-key2','value2'));// 设置成功返回1，若重复的

// 获取hash-key 中sub-key2的值
var_dump($redis->hget('hash-key','sub-key2'));

// 获取hash-key中的所有值,注意输出顺序
/*array(2) {
  ["sub-key2"]=>
  string(6) "value2"
  ["sub-key1"]=>
  string(6) "value1"
}*/
var_dump($redis->hgetall("hash-key"));

var_dump($redis->hdel('hash-key','sub-key')); // 该键不存在，返回int 0，存在返回1

var_dump($redis->hgetall("hash-key"));

$redis->hdel('hash-key','sub-key1'); // 该键不存在，返回int 0

var_dump($redis->hgetall("hash-key"));

$redis->hdel('hash-key','sub-key2'); // 该键不存在，返回int 0

var_dump($redis->hgetall("hash-key"));