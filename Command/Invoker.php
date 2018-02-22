<?php
namespace command;

class Invoker {
    private $_command;

    public function set_commander(Command $command) {
        $this->_command = $command;
    }

    public function action() {
        $this->_command->execute();
    }
}