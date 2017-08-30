<?php
namespace di_ioc;

class Foo {

    private $boo;
    public function __construct(Boo $boo) {
        $this->boo = $boo;
    }

    public function do_anything() {
        $this->boo->do_anything();
        echo __CLASS__ . ' is doing ...<br>';
    }
}


