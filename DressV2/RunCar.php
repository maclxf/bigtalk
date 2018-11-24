<?php
/**
 * Created by PhpStorm.
 * User: Maclxf
 * Date: 2018/8/25
 * Time: 15:15
 */

namespace DressV2;

use DressV2\Car;
class RunCar implements Car
{
    public function run()
    {
        echo '路上开<br>';
    }

    public function show()
    {
        $this->run();
    }
}