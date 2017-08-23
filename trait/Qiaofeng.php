<?php
require_once('Person.php');
require_once('Gongfu.php');
require_once('Gongfu1.php');

Class Qiaofeng extends Person {
    use Gongfu, Gongfu1;
    public function say() {
        echo '我是乔峰！';
    }

    public function dragon18z() {
        echo '我不仅仅会降龙十八掌，我还会打狗棍';
    }
}