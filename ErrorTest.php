<?php
echo 1;
echo 2;

// 语法 
// 运行时错误
// 逻辑

// 错误级别
error_reporting(~E_WARNING);

// 表锁        对于该表的修改 新增操作都会停止
// 行锁        对于该行的修改 新增操作都会停止
// 索引的影响   对于条件字段如果加了索引 那么不会造成表锁
// 范围锁       如果操作的记录在范围内容 会造成停止

// 悲观锁 for update
// 乐观锁 where ver = ver+1 and id = 1

// 读锁
LOCAK TABLE 表名 READ;
UNLOCK 表名

// 写锁
LOCAK TABLE 表名 WRITE;
UNLOCK 表名

// 终端1
set autocommit = 0;
update adi_product set name ='怪兽' where id =14
commit

// 终端2
set autocommit = 0;
update adi_product set name ='kk' where id =14 //阻塞
