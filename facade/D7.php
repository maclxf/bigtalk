<?php
namespace Facade;
use Facade\Player;
class D7 extends Player{
    public function __construct () {
        $name = 'Beckham';
        parent::__construct($name);
    }

    public function foot_shoot() {
        echo $this->name . '圆月弯刀射门！<br>';
    }

    public function run_with_football() {
        echo $this->name . '急停转身过人！<br>';
    }
}