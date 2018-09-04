<?php
namespace AbstractFactory\Fruit;

// 产品结构
class SouthApple extends Bear {
    public function getFruit() {
        echo '南方苹果<br>';
    }
}
