<?php
require_once 'name_space/Demo.php';
// 调用命名空间NameSpaceDemo中的Demo
use NameSpaceDemo\Demo; //若支注释掉这个不注释掉demo.php中的namespace也不会得到正确的值，因为demo归纳到namespace的命名空间当中


$demo = new Demo();



echo '<HR>';


// 导入一个命名空间
use NameSpaceDemo1\BBS;
//如果是子空间还应把子空间的名带上，作为限定名称
$demo1 = new BBS\Demo1();
$demo1->show_me();
echo '<br>在外层非class的内层访问用NameSpaceDemo1\constDefine：' . BBS\constDefine;



echo '<HR>';

// 导入一个类并使用别名
use NameSpaceDemo1\BBS\Demo1 as test;
//use NameSpaceDemo1\constDefine as testconst; 常亮不能像对象一样用别名
//Notice: Use of undefined constant testconst - assumed 'testconst' in E:\project\bigtalk\test_namespace.php on line 12
$test = new test();
$test->show_me();

echo '<br>在外层非class的内层访问用NameSpaceDemo1\constDefine：' . NameSpaceDemo1\BBS\constDefine;