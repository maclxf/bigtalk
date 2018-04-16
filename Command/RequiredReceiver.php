<?php
namespace command;
use command\Receiver;


class RequiredReceiver extends Receiver {

    public function find() {
        echo '找到产品经理<br>';
    }

    public function add() {
    }

    public function delete() {
    }

    public function plan() {
        echo '产品经理设计产品<br>';
    }

}