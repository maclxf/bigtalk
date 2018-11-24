<?php
/**
 * Created by PhpStorm.
 * User: Maclxf
 * Date: 2018/8/25
 * Time: 15:18
 */

namespace DressV2;

use DressV2\Car;
abstract class Decorator implements Car
{
    private $car;

    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    public function __get(String $name) {
        return $this->$name;
    }


}