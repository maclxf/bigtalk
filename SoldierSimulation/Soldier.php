<?php
namespace SoldierSimulation;

class Soldier extends Observer
{


    public function help() {
        echo $this->name . '收到指令，马上前往支援！<br>';
    }

    public function underAttack(Subject $wcc) {
        echo $this->name . '收到攻击，请求支援！<br>';

        $wcc->notice($this->name);
    }

}