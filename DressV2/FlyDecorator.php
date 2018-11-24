<?php
/**
 * Created by PhpStorm.
 * User: Maclxf
 * Date: 2018/8/25
 * Time: 15:18
 */

namespace DressV2;

use DressV2\Decorator;

class FlyDecorator extends Decorator
{
    public function fly()
    {
        echo '天上飞<br>';
    }

    public function show()
    {
        $this->car->show();
        $this->fly();
    }
}