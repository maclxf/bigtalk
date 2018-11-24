<?php
namespace Facade;
use Facade\Player;

class Kd35 extends Player{
    public function __construct () {
        $name = 'Durant';
        parent::__construct($name);
    }

    public function hand_shoot() {
        echo $this->name . '急停跳投！<br>';
    }

    public function run_with_basketball() {
        echo $this->name . '胯下运球节奏变化过人！<br>';
    }
}