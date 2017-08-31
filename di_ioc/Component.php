<?php
namespace di_ioc;

class Component {

    private $di;

    public function __construct(Di $di) {
        $this->di = $di;
    }

    public function task() {
        // new in
        $some_one = $this->di->get('a');
        $some_one->match();
    }

    public function other_task() {
        // same in
        $this->di->get_share_a();
        $some_one->match();

        $this->di->get('a');
        // new in
        $this->di->get('b');
    }
}


