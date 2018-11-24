<?php
namespace SoldierSimulation;

class WarControllerCenter extends Subject
{

    public function notice(string $name) {
        if ($this->soldiers) {
            foreach ($this->soldiers as $soldier) {
                if ($name != $soldier->getName()) {
                    $soldier->help();
                }
            }
        }
    }
}