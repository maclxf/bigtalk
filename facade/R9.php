<?php
require_once('Player.php');

class R9 extends Player{
    public function __construct () {
        $name = 'Ronaldo';
        parent::__construct($name);
    }

    public function foot_shoot() {
        echo $this->name . '大力抽射！<br>';
    }

    public function run_with_football() {
        echo $this->name . '钟摆过人！<br>';
    }
}