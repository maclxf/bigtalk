<?php

require_once './factory/Opreator/Opreator.php';
class AddOpreator extends Opreator {
    public function __construct(int $NumberA, int $NumberB) {
        parent::__construct($NumberA, $NumberB);
    }

    public function getresult() {
        return ($this->NumberA + $this->NumberB);
    }
}