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
        $some_one =$this->di->get('a');
        $some_one->match();
        // same in
        $some_one_old = $this->di->get_share_a();
        $some_one_old->match();


        // new in
        $some_one_b = $this->di->get('b');
        $some_one_b->match();
    }
}


