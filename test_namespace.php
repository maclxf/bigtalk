<?php
require_once 'name_space/Demo.php';
// 调用命名空间NameSpaceDemo中的Demo
//use NameSpaceDemo\Demo; //若支注释掉这个不注释掉demo.php中的namespace也不会得到正确的值，因为demo归纳到namespace的命名空间当中

new Demo();