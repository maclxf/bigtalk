<?php

include_once('Dress.php');
//具体装饰类
// 短裤类
class DressB extends Dress {

    public function operation() {
        parent::operation();
        $this->make_broken();
        echo '短裤';
    }

    public function make_broken() {
        echo ' 故意弄得脏兮兮的';
    }

}