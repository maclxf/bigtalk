<?php
require_once('facade/D7.php');
require_once('facade/R9.php');
require_once('facade/Kd35.php');

class Facade {
    protected $r9;
    protected $d7;
    protected $kd35;

    public function __construct() {
        $this->r9 = new R9();
        $this->d7 = new D7();
        $this->kd35 = new Kd35();
    }

    public function shoot () {
        $this->r9->foot_shoot();
        $this->d7->foot_shoot();
        $this->kd35->hand_shoot();
    }

    public function run () {
        $this->r9->run_with_football();
        $this->d7->run_with_football();
        $this->kd35->run_with_basketball();
    }
}