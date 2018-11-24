<?php
namespace SoldierSimulation;


abstract class Observer
{
    protected $name;
    public function __construct(string $name) {
        $this->name = $name;

    }

    /*public function setWarCC(Subject $wcc) {
        $this->wcc = $wcc;
    }*/

    public function setName(string $name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    abstract public function help();

    abstract public function underAttack(Subject $wcc);
}