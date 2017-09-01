<?php
namespace di_ioc;

use di_ioc\TT;
class A implements TT{

    public function match() {
        $time = 1;
        $str = '我是' . __METHOD__ . '第' . $time . '次调用' . '<br>';
        echo $str;
        $time++;
    }

}


