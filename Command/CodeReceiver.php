<?php
namespace command;
use command\Receiver;


class CodeReceiver extends Receiver {

    public function find() {
        echo '找到码农<br>';
    }

    public function add() {
        echo '码农开始码代码了<br>';
    }

    public function delete() {
        echo '码农删除代码了<br>';
    }

    public function plan() {
    }

}