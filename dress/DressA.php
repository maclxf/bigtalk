<?php

include_once('Dress.php');
//具体装饰类
//T-shirt 类
class DressA extends Dress {
    protected $color;

    public function operation() {
        parent::operation();
        $this->color = '蓝色';
        echo ' ' . $this->color . 'T-shirt';
    }
}