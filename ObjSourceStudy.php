<?php


class A
{
    public $name = 1;
}

$a = new A();
$b = $a;// 传不传引用结果完全不同

$b->name = 2;
echo '<pre>';
var_dump('a：'.$a->name);//2


$a = new A();
$c = $b;
$b->name = 4;

var_dump('a：'.$a->name);//1
var_dump('b：'.$b->name);//4
var_dump('c：'.$c->name);//4