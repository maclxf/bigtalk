<?php

require_once 'Opreator.php';

class AddOpreator {
    public function __construct(int $NumberA, int $NumberB) {
        parent::__construct($NumberA, $NumberB);
    }

    public function getresult() {
        return ($NumberA + $NumberB);
    }
}