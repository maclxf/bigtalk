<?php
namespace command;
use command\Command;
use command\CodeReceiver;
use command\RequiredReceiver;

class AddRequiredCommand extends Command {

    private $_cr;
    private $_re;

    public function __construct() {
       $this->_cr = new CodeReceiver();
       $this->_re = new RequiredReceiver();
    }

    public function execute() {

        echo'=============加需求了哦===================<br>';
        $this->_re->find();
        $this->_cr->find();

        $this->_re->plan();
        $this->_cr->add();
    }
}