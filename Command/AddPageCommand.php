<?php
namespace command;
use command\Command;
use command\PageReceiver;

class AddPageCommand extends Command {


    public function __construct() {
       $this->_pg = new PageReceiver();
    }

    public function execute() {

        echo'=============加页面了哦===================<br>';
        $this->_pg->find();
        $this->_pg->plan();
        $this->_pg->add();
    }
}