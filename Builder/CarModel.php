<?php
namespace builder;

abstract class CarModel {
    private $sequence = array();
    public function __construct() {

    }

    abstract protected function start();

    abstract protected function stop();

    abstract protected function alarm();

    abstract protected function engineBoom();

    final public function run() {
        foreach ($this->sequence as $seq) {
            if ($seq == 'start') {
                $this->start();
            } elseif ($seq == 'stop') {
                $this->stop();
            } elseif ($seq == 'alarm') {
                $this->alarm();
            } elseif ($seq == 'engineBoom') {
                $this->engineBoom();
            }
        }
    }

    final public function setSequence(array $sequence) {
        $this->sequence = $sequence;
    }
}
