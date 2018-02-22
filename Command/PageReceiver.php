<?php
namespace command;
use command\Receiver;


class PageReceiver extends Receiver {

    public function find() {
        echo '找到前端<br>';
    }

    public function add() {
        echo '前端弄页面了<br>';
    }

    public function delete() {
        echo '前端删除了页面<br>';
    }

    public function plan() {
    }

}