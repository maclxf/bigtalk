<?php
require_once('Person.php');
require_once('Gongfu.php');
require_once('Gongfu1.php');

Class Guojing extends Person {
    use Gongfu, Gongfu1 {
        Gongfu1::dragon18z insteadof Gongfu;
        Gongfu1::dragon18z as strongzhi;
    }
    public function say() {
        echo '我是郭靖！';
    }

    /*public function dragon18z() {
        echo '我不仅仅会降龙十八掌，我还会射雕';
    }*/
}