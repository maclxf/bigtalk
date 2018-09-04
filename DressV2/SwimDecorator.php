<?php
/**
 * Created by PhpStorm.
 * User: Maclxf
 * Date: 2018/8/25
 * Time: 15:18
 */

namespace DressV2;

use DressV2\Decorator;

class SwimDecorator extends Decorator
{
    public function swim()
    {
        echo '水头游<br>';
    }

    public function show()
    {
        $this->car->show();
        $this->swim();
    }
}