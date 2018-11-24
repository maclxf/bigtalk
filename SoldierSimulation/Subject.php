<?php
namespace SoldierSimulation;

abstract class Subject
{
    protected $soldiers;

    public function add(Observer $soldier) {
        $this->soldiers[] = $soldier;
    }

    public function remove() {
        # ... 如何删除数组中的某个对象，而不用循环
    }

    abstract public function notice(string $name);
}