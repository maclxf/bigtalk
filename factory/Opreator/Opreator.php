<?php

abstract class Opreator {
    protected $NumberA;
    protected $NumberB;

    public function __construct(int $NumberA, int $NumberB) {
        $this->NumberA = $NumberA;
        $this->NumberB = $NumberB;
    }

    abstract public function getresult();
}