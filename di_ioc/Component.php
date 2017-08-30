<?php
//namespace di_ioc;

class Component {

    private $di;

    public function __construct(Di $di) {
        $this->di = $di;
    }

    public function task() {
        // new in
        $this->di->get();
    }

    public function other_task() {
        // same in
        $this->di->get_share();

        // new in
        $this->di->get();
    }
}


