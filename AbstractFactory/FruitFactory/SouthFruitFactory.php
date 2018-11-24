<?php
namespace AbstractFruitFactory;

use AbstractFruit\SouthApple;
use AbstractFruit\SouthBear;

// 产品结构
class SouthFruitFactory extends FruitFactory {
    public function getApple() {
        return new SouthApple();
    }

    public function getBear() {
        return new SouthBear();
    }
}