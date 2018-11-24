<?php
// 定义一个叫NameSpaceDemo的命名空间
namespace NameSpaceDemo;

class Demo {

    /*public function __construct() {
        echo 'Demo __NAMESPACE__ is ' . __NAMESPACE__ . '<br>';
    }*/

    public function show_me() {
        echo 'Demo __NAMESPACE__ is ' . __NAMESPACE__ . '<br>';
    }
}


// 另一个命名空间
namespace NameSpaceDemo1\BBS;
// NameSpaceDemo1中定义的变量
const constDefine = '我是外层的constDefine';

class Demo1 {
    const constDefine = '我是内层的constDefine';

    /*public function __construct() {
        echo 'Demo1 __NAMESPACE__ is ' . __NAMESPACE__ . '<br>';
        echo '外层const的访问直接用本身定义的变量constDefine：' . constDefine . '<br>';
        echo '内层const的访问要用self::constDefine：' . self::constDefine;
    }*/

    public function show_me() {
        echo 'Demo1 __NAMESPACE__ is ' . __NAMESPACE__ . '<br>';
        echo '外层const的访问直接用本身定义的变量constDefine：' . constDefine . '<br>';
        echo '内层const的访问要用self::constDefine：' . self::constDefine;
    }
}