<?php
namespace AbstractFruitFactory;

use AbstractFruit\NorthApple;
use AbstractFruit\NorthBear;


// 产品结构
class NorthFruitFactory extends FruitFactory {
    public function getApple() {
        return new NorthApple();
    }

    public function getBear() {
        return new NorthBear();
    }
}
