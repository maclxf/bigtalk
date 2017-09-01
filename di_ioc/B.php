<?php
namespace di_ioc;

use di_ioc\TT;
class B implements TT{

    public function match() {
        $str = '我是' . __METHOD__ . '<br>';
        echo $str;

    }

}
